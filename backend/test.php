<?php

include_once("conexao.php");

mysqli_multi_query($conexao,"DELIMITER $$
CREATE PROCEDURE citycount (IN country INT, OUT cities INT)
       BEGIN
         SELECT COUNT(*) INTO cities FROM fase WHERE id = country;
 END $$
 
 DELIMITER ;");

