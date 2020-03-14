<?php 

    /**
    * 
    */
    class Database
    {
        /**
         * Khai báo biến kết nối
         * @var [type]
         */
        public $link;

        public function __construct()
        {
            $this->link = mysqli_connect("localhost","root","","webshop2") or die ();
            mysqli_set_charset($this->link,"utf8");
        }

        

        /**
         * [insert description] hàm insert 
         * @param  $table
         * @param  array  $data  
         * @return integer
         */
        public function insert($table, array $data)
        {
            //code
            $sql = "INSERT INTO {$table} ";
            $columns = implode(',', array_keys($data));
            $values  = "";
            $sql .= '(' . $columns . ')';
            foreach($data as $field => $value) {
                if(is_string($value)) {
                    $values .= "'". mysqli_real_escape_string($this->link,$value) ."',";
                } else {
                    $values .= mysqli_real_escape_string($this->link,$value) . ',';
                }
            }
            $values = substr($values, 0, -1);
            $sql .= " VALUES (" . $values . ')';
            // _debug($sql);die;
            mysqli_query($this->link, $sql) or die("Lỗi  query  insert ----" .mysqli_error($this->link));
            return mysqli_insert_id($this->link);
        }

        public function update($table, array $data, array $conditions)
        {
            $sql = "UPDATE {$table}";

            $set = " SET ";

            $where = " WHERE ";

            foreach($data as $field => $value) {
                if(is_string($value)) {
                    $set .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\',';
                } else {
                    $set .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ',';
                }
            }

            $set = substr($set, 0, -1);


            foreach($conditions as $field => $value) {
                if(is_string($value)) {
                    $where .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\' AND ';
                } else {
                    $where .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ' AND ';
                }
            }

            $where = substr($where, 0, -5);

            $sql .= $set . $where;
            // _debug($sql);die;

            mysqli_query($this->link, $sql) or die( "Lỗi truy vấn Update -- " .mysqli_error());

            return mysqli_affected_rows($this->link);
        }
        public function updateview($sql)
        {
            $result = mysqli_query($this->link,$sql)  or die ("Lỗi update view " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);

        }
        public function countTable($table)
        {
            $sql = "SELECT id FROM  {$table}";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }


        /**
         * [delete description] hàm delete
         * @param  $table      [description]
         * @param  array  $conditions [description]
         * @return integer             [description]
         */
        public function delete ($table ,  $id )
        {
            $sql = "DELETE FROM {$table} WHERE id = $id ";

            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        /**
         * delete array 
         */
        
        public function deletewhere($table,$data = array())
        {
            foreach ($data as $id)
            {
                $id = intval($id);
                $sql = "DELETE FROM {$table} WHERE id = $id ";
                mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            }
            return true;
        }

        public function fetchsql( $sql )
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        } 

        public function fetchID($table , $id )
        {
            $sql = "SELECT * FROM {$table} WHERE id = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        public function fetchOne($table , $query)
        {
            $sql  = "SELECT * FROM {$table} WHERE ";
            $sql .= $query;
            $sql .= "LIMIT 1";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchOne " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }
        

        public function deletesql ($table ,  $sql )
        {
            $sql = "DELETE FROM {$table} WHERE " .$sql;
            // _debug($sql);die;
            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        

         public function fetchAll($table)
        {
            $sql = "SELECT * FROM {$table} WHERE 1" ;
            $result = mysqli_query($this->link,$sql) or die("Lỗi Truy Vấn fetchAll " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

    
        public  function fetchJones($table,$sql,$total = 1,$page,$row ,$pagi = true )
        {
            
            $data = [];

            if ($pagi == true )
            {
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row ";
                $data = [ "page" => $sotrang];
              
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            else
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            
            return $data;
        }
         public  function fetchJone($table,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
            // _debug($sql);die;
            if ($pagi == true )
            {
                $total = $this->countTable($table);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            else
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            // _debug($data);
            return $data;
        }


        public  function fetchJoneDetail($table , $sql ,$page = 0,$total ,$pagi )
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));

            $sotrang = ceil($total / $pagi);
            $start = ($page - 1 ) * $pagi ;
            $sql .= " LIMIT $start,$pagi";

            $result = mysqli_query($this->link , $sql);
            $data = [];
            $data = [ "page" => $sotrang];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function total($sql)
        {
            $result = mysqli_query($this->link  , $sql);
            $tien = mysqli_fetch_assoc($result);
            return $tien;
        }
        //ham lay 1 hang
        public function db_single($sql)
        {
            $result = mysqli_query($this->link  , $sql);
            $single = mysqli_fetch_assoc($result);
            return $single;
        }
        //ham query
        public function db_query($sql)
        {
            $result = mysqli_query($this->link  , $sql);
            return $result;
        }
            
        public function escapePostParam($key) {
            return mysqli_real_escape_string($this->link, $_POST[$key]);
        }
        
        public function escapeGetParam($key) {
            return mysqli_real_escape_string($this->link, $_GET[$key]);
        }

        //ham add product
        function addProduct($name, $slug, $thumbnail, $category_id, $content) {
            return mysqli_query($this->link ,
                "INSERT INTO `products`(`name`, `slug`, `thumbnail`, `category_id`, `content`) 
                VALUES ('$name', 
                        '$slug', 
                        '$thumbnail', 
                        $category_id, 
                        '$content')"
                        );
        }
        //ham add phone
        function addPhone($product_id, $imei, $color_id, $rom_id, $ram_id, $chip, $bettery, $camera, $display, $price, $qty, $sale, $thumbnail) {
            return mysqli_query($this->link ,
                "INSERT INTO `phone`(`product_id`, `imei`, `color_id`, `rom_id`, `ram_id`, `chip`, `bettery`, `camera`, `display`, `price`, `qty`, `sale`, `thumbnail`) 
                VALUES ($product_id, 
                        $imei, 
                        $color_id, 
                        $rom_id,
                        $ram_id, 
                        '$chip', 
                        '$bettery', 
                        '$camera', 
                        '$display', 
                        $price, 
                        $qty,
                        $sale,
                        '$thumbnail')"
                        );
        }
        //ham edit pot
        function editProduct($id, $name, $slug, $price, $sl, $sale, $thumbnail, $category_id, $content, $updated_at) {
            $sql = "UPDATE `product` SET";
            $sql .= " name='".$name."'";
            if(!empty($thumbnail)){
                $sql .= ", thumbnail='".$thumbnail."'";
            }
            $sql .= ", slug='".$slug."'";
            $sql .= ", price='".$price."'";
            $sql .= ", sl='".$sl."'";
            $sql .= ", sale='".$sale."'";
            $sql .= ", content='".$content."'";
            $sql .= ", category_id='".$category_id."'";
            $sql .= ", updated_at='".$updated_at."'";
            $sql .= " WHERE id=".$id;
            return mysqli_query($this->link, $sql);
        }
        //ham get product
        function getProduct($id) {
            return mysqli_query($this->link, "SELECT *
            FROM  product
            WHERE id = $id");
        }
        //ham get admin
        //0 la admin
        //1 la user
        //2 la ncc
        function getAdmin() {
            return mysqli_query($this->link, "SELECT * from account where position = 0");
        }

        //ham add user
        function addUser($name, $password, $email, $phone, $address, $avatar) {
            return mysqli_query($this->link ,
                "INSERT INTO `account`(`name`, `password`, `email`, `phone`, `address`, `avatar`, `level`) 
                VALUES ('$username', 
                        '$password', 
                        '$email', 
                        $phone,
                        '$address', 
                        ' $avatar', 
                        1)"
                        );
        }
        //ham bill exp
        function addBillExport($amount, $user_id, $address, $note) {
            mysqli_query($this->link ,
                "INSERT INTO `bill_export`(`amount`, `user_id`, `address`, `note`) 
                VALUES ($amount, 
                        $user_id,
                        '$address',
                        '$note')"
                        );
            return mysqli_insert_id($this->link);
        }
        //get transaction
        function getTransaction() {
            return mysqli_query($this->link, "SELECT t.*, a.name as name1, a.phone as phone from bill_export t join account a on t.user_id = a.id 
            where a.level = 0
            order by id desc");
        }
        //ham detail bill exp
        function addDetailBillExport($transaction_id, $product_id, $qty, $price) {
            mysqli_query($this->link ,
                "INSERT INTO `detail_bill_export`(`bill_export_id`, `product_id`, `qty`, `price`) 
                VALUES ($transaction_id, 
                        $product_id,
                        $qty,
                        $price)"
                        );
            return mysqli_insert_id($this->link);
        }

    }
   
?>