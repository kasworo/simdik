<?php
    function cekuser($data){
        global $conn;
        $sql=$conn->query($data);
        return $sql->num_rows;
    }

    function viewuser($data){
        global $conn;
        $sql=$conn->query($data);
        $rows=[];
        while($row=$sql->fetch_assoc()){
            $rows[]=$row;
        }
        return $rows;
    }
    
    function addadmin($data){
        global $conn;
        $nama=ucwords(strtolower($data['nama']));
        $user=stripslashes($data['user']);
        $paswd=$conn->real_escape_string($data['paswd']);
        $conf=$conn->real_escape_string($data['conf']);
        if($passwd!==$conf){
            echo "<script>
                    $(function() {
                        toastr.error('Isian Password dan Konfirmasinya Tidak Sama!','Mohon Maaf',{
                            timeOut:1000,
                            fadeOut:1000,
                            onHidden:function(){
                                window.location.reload();
                            }
                        });
                    });
                </script>";
            return false;
        }
        $password=password_hash($paswd,PASSWORD_DEFAULT);
        $sql="INSERT INTO tbuser (username, nama, level, passwd, aktif) VALUES ('$user', '$nama', '1', '$password', '1')";
        $conn->query($sql);
        return $conn->affected_rows;
    }

    function adduser($data,$lev){
        global $conn;
        $nama=$data['nama'];
        $user=stripslashes($data['user']);
        $paswd=$conn->real_escape_string($data['paswd']);
        $password=password_hash($paswd,PASSWORD_DEFAULT);
        $sql="INSERT INTO tbuser (username, nama, level, passwd, aktif) VALUES ('$user', '$nama', '$lev', '$password', '1')";
        $conn->query($sql);
        return $conn->affected_rows;
    }

    function deluser(){
        global $conn;
        $sql="DELETE FROM tbuser WHERE level<>'1'";
        $conn->query($sql);
        return $conn->affected_rows;
    }
    
?> 