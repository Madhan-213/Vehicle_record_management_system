<?php
 $servername="localhost";
 $username="root";
 $password="";
 $dbname="vehicli";

 //cont connection

 $conn =new mysqli($servername, $username, $password ,$dbname);

 //check error
 if($conn->connect_error){
     die("connection failed:".$conn->connect_error);
 }
 else{
         echo("connetced");
 }
        //user input

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $cname=$_POST["cname"];
            $dob=$_POST["dob"];
            $email=$_POST["email"];
            $id_proof=$_POST["id_Proof"];
            $mobile=$_POST["mobile"];
            // $reg_num=$_POST["reg_num"];
            $vehicle_name=$_POST["vehicle_name"];
            $eng_num=$_POST["eng_num"];
            $rc_num=$_POST["rc_num"];
            
        }
        // inser values
        $sql="INSERT INTO data(cname,dob,email,id_proof,mobile,vehicle_name,eng_num,rc_num) VALUES ('$cname','$dob','$email','$id_proof','$mobile','$vehicle_name','$eng_num','$rc_num')";

        if(mysqli_query($conn, $sql)){
            echo "<script>
    alert('Vehicle details Added successfully!');
    window.location.href = 'staff-page.html'; 
  </script>";
        }
        else{
            echo"ERROR : not inserted $sql".mysqli_error($conn);
        }
        $conn->close();


    ?>