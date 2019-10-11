<?php
echo "<h1>Codage des lutilisateur avec password_hash</h1>";
echo "<h2>sylviane.mol</h2>";
echo $a = password_hash("sylviane",PASSWORD_DEFAULT);
echo "<br>";
echo "<h2>pierre.sandron</h2>";
echo $b = password_hash("pierre",PASSWORD_DEFAULT);
echo "<br>";
echo "<h2>oumar.abakar</h2>";
echo $c = password_hash("oumar",PASSWORD_DEFAULT);
echo "<br>";
echo "<h2>dimitri.bouvy</h2>";
echo $d = password_hash("dimitri",PASSWORD_DEFAULT);
echo "<br>";
echo  "<h2>tarik.el</h2>";
echo $f =password_hash("tarik",PASSWORD_DEFAULT);
echo "<h2>michael.pitz</h2>";
echo $e = password_hash("michael",PASSWORD_DEFAULT);
echo "<br>";
echo password_verify("sylviane",$a);
echo "<br>";
echo password_verify("pierre",$b);
echo "<br>";
echo password_verify("oumar",$c);
echo "<br>";
echo password_verify("dimitri",$d);
echo "<br>";
echo password_verify("michael",$e);
echo "<br>";
echo password_verify("tarik",$f);
echo "<br>";




$mdp = ["admin","test","xc25d9"];

foreach ($mdp AS $key => $item){
    $arr[$key]=password_hash($item,PASSWORD_DEFAULT);
    $unique[]=uniqid('key',true);
    echo (password_verify($item,$arr[$key]))? "ok<br>" : "ko<br>";
}

echo "<pre>";
var_dump($arr,$unique);
echo "</pre>";

foreach ($mdp AS $key => $item){
    $arr[$key]=password_hash($item,PASSWORD_DEFAULT);
    echo (password_verify($item,$arr[$key]))? "ok<br>" : "ko<br>";
}
foreach ($mdp AS $key => $item){
    echo (password_verify($item,$arr[$key]))? "ok<br>" : "ko<br>";
}
echo "<pre>";
var_dump($arr,$unique);
echo "</pre>";