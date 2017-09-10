<?php
//declare(encoding='utf-8');
//declare(strict_types=1);
//declare must be th e very first statement, require enable zend-multibyte 
//namespace A\B\C; must be very first statement 
/* 
multiple lines
comment 
*/
//tag
$isDisplay = true;
$message = 'another asp style output';
function sp($title){
    print("\n-----------------------$title--------------------\n");
}
?>

<?php
sp('advanced tag');
?>
<?php if ($isDisplay == true): ?>
This will show if the isDisplay is true.
<?php else: ?>
Otherwise this will show.
<?php endif; ?>

<?="direct output content\n"?>

<?php 
//till the end of line are all php code 
echo (int) ( (0.1+0.7) * 10 ); // echoes 7!

sp('false expressions');
if((False && 0 && 0.0 && [] && NULL && '') == FALSE)
{
    echo "\nfalse \n";
}

sp('value assignment');  
$int_value = (int)'3.14';
$copy_by_value = $int_value;
$copy_by_value = 3.1415;
var_dump($int_value);
$ref_value = &$int_value;
$ref_value = 3.1415;
var_dump($int_value);
function &foo_static(){
    return 1;
}


sp('float number');
$a = 1.234; 
$b = 1.2e3; 
$c = 7E-10;
$epsilon = 0.00001;
if(abs($a-$b) < $epsilon) {
    echo "very small value\n";
}

sp('heredoc and nowdoc');
//string only support 256 character set 
$var = '***';
print("\$var will expand $var \n");

$heredoc = <<<"EOT"
heredoc:
all the following line 
are all document string till the custom close symnbol 
${var}

EOT;
echo $heredoc;

$nowdoc = <<<'EOT'
nowdoc:
all the following line 
are all document string till the custom close symnbol 
$var

EOT;

sp('variable convert to string');
echo strval(15.2314)."\n".strval(TRUE)."\n".strval(NULL);

//nagative index only fit for string 
$ary = '1234';
is_numeric($ary);
$ary[1] === $ary[-3]? print('ok'):print('fail');

//convert string to number, mixed string value with number will trigger warning 
$foo = 1 + "10.5";                // $foo is float (11.5)

//Use the ord() and chr() functions to convert between ASCII codes and characters.
echo chr(ord('a'))."\n";

sp('array assignment');
$ary = array('a'=> 1, 'b'=>2);
$ary = array('a', 'b', 6=>'c','d');
var_dump($ary);

sp('remove a value from array');
unset($ary[1]);
//after remove a item we need reindex the array to make it sequence
$ary = array_values($ary);
var_dump($ary);

sp('class inherit and definiion, convert object to array');
//object could be convert to array 
interface IA{
}

class A implements IA{
    public $p0;
    public $p1;
    static function foo(){
        print("\nA::foo called\n");
    }
    function foo0(){
        print("\nA::foo0 called\n");
    }
    function __invoke($msg = ' hello'){
        print("direct invoke object of A".$msg);
    }
}

class B extends A{
    function foo0(){
        print("\nB::foo0 called\n");
    }
}

class C extends A{
    function foo0(){
        echo "call A::foo0 from C::foo0\n";
        parent::foo0();
    }
}

$a = new A();
$a();
$a->p0 = 'p0';
$a->p1 = 'p1';
var_dump((array)$a);

$c = new C();
$c->foo0();

sp('array iteration');
$ary0 = $ary;
foreach($ary as $index => $item){
    print(strval($index)." ".strval($item)."\n");
}

$ary0[0] = 'new value';
foreach($ary0 as $index => $item){
    print(strval($index)." ".strval($item)."\n");
}

var_dump(array_diff($ary, $ary0));

sp('define iterable item');
//define function return iterable type 
function foo():iterable{
    return [1,2,3];
}
function gen():iterable{
    yield 1;
    yield 2;
}
foreach(foo() as $index=>$value){
    print($value);
}

sp('using callback');
//use callback function 
function callback(){
    print("\ncallback called\n");
}
call_user_func('callback');
call_user_func('A::foo');
call_user_func(array('A', 'foo'));
call_user_func(array(new A(), 'foo0'));
call_user_func(array(new B(), 'parent::foo0'));
call_user_func(new A(), ' hello object of A');
//call callback as varaible 
$callback = 'callback';
$callback();
$func = array('A', 'foo');
$func();

sp('predefined global variables');
//$GLOBALS;
//$_SERVER;
//$_GET;
//$_POST;
//$_FILES;
//$_REQUEST;
//$_SESSION;
//$_ENV;
//$_COOKIE;
//$php_errormsg;
//$HTTP_RAW_POST_DATA;
//$http_resposne_header;
//$argc;
//$argv;

//dot space in variable name are automatic convert to underscore 

sp('variable scope, php support function scope');
$gVar = 2;
function var_scope_test(){
    static $var_scope_value = 0;
    $local = 1;
    global $gVar;
    print($gVar);
}
var_scope_test();

sp('variable variables,like pointer in c');
$var_name = 'name';
$vvar_name = 'var_name';
print("${$vvar_name}"); //echo name


sp('constent variable');
//get all defined constants
$constents = get_defined_constants();

sp('operators similar to C');
echo 2**3, "\n";

$ary0 = [1,2,3];
$ary1 = [1,2,3];
$ary2 = [2,3,4,5];
var_dump($ary0+$ary2); //union of two array, echo [1,2,3,5]. union by key value
$ary0 <> $ary1? print('true'):print('false');

sp('detect whether a php variable is an instantiated object');
$a = new A();
var_dump($a instanceof A);

sp('control structure similar to C');
declare(ticks=1){
    function tick_handler(){
        echo 'tick_handler called';
    }

    register_tick_function('tick_handler');
}

sp('include modules');
require('./module-a.php');
require('./module-b.php');
require_once('./module-a.php');
include_once('./module-b.php');

sp('goto statement');
goto label;
print('will not be shown');
label:

sp('anonyous function');
(function(){
    print("anonymous called. \n");
})();

abstract class TBase{
    abstract public function build();
}

class T extends TBase{
    function __construct(){
        echo "T.__construct called \n";
    }

    public function build(){
        return function(){
            var_dump($this);
        };
    }

    public function area(){
        return self::E * 2 *10;
    }

    public $build = 5;

    public static $PI = 3.14159;

    public const E = 2.71828;

    function __destruct(){
        echo "T.__destruct called \n";
    }

    
}

$t0 = new T();
($t0->build())();
echo $t0->build;
echo $t0->area();

sp('autoload class and interface');
spl_autoload_register(function($class_name){
    include $class_name.'php';
});

sp('traits is used to horizontal compoistion behaviors');

trait ReflectionInfo{
    function getReturnType(){ return "type\n";}
    function hello(){
        parent::hello();
    }
}

class P0{
    function hello(){
        echo "P0::hello\n";
    }
}

class P1{
    function hello(){
        echo __CLASS__;
        echo "P1::hello\n";
    }
}

class C0 extends P0{
    use ReflectionInfo;
}

class C1 extends P1{
    use ReflectionInfo;
}

class CUseTrait{
    private $_data = array();
    use ReflectionInfo;
    
    public function __set($name, $value){
        echo "setting $name to $value \n";
        $this->_data[$name] = $value;
    }
}

$cut = new CUseTrait();
$cut->p = 'p';
echo $cut->getReturnType();
$c0 = new C0();
$c1 = new C1();

$c0->hello();
$c1->hello();

sp('nested function');
function wrapper(){
    class CW{

    }

    function nest(){
        echo "nest called\n";
    }

    nest();
    $cw = new CW();
}
wrapper();

sp('iterator interface');
class MyIter implements Iterator
{
    public function rewind(){}
    public function current(){}
    public function key(){}
    public function valid(){}
    public function next(){return 'a';}
}

/*
magic methods, The function names 
__construct(), 
__destruct(),
__call(), 
__callStatic(),
__get(), 
__set(), 
__isset(),
__unset(), 
__sleep(), 
__wakeup(), 
__toString(), 
__invoke(), 
__set_state(), 
__clone(),
__debugInfo() are magical in PHP classes. 
*/

sp('object clone __clone method cannot be direct called');
$datetime = new DateTime();
echo (clone $datetime)->format('Y');

sp('define namespace');

sp('end');

