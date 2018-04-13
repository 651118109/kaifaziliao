<?php
/**
 * 专门用于操作数据库的类
 * @author LAOYANG
 *
 */
//引入常量配置文件
require_once 'config.php';

//类名
class Mysqldb{
//私有属性
    //连接对象
    public  $mysqli;
    //查询结果
    private $result;
    //两个下划线的都是魔术方法   new当前类的时候会触发构造方法
    public function __construct()
    {
        //创建对象并打开连接，最后一个参数是选择的数据库名称
        $this->mysqli=$this->mysqli();
        //检查连接是否成功
        if (mysqli_connect_errno())
        {
            //注意mysqli_connect_error()新特性
            die('无法连接指定数据库!'). mysqli_connect_error();
        }
		mysqli_query($this->mysqli,"SET NAMES 'utf8'");
        
    }
    public function mysqli()
    {
        return mysqli_connect(HOST,USR,PWD,DBNAME);
    }
    /**
     * 
     * 专门用于执行查询的select语句
     * @param $sql:select语句
     */
    public function query_lists($sql)
    {
        //如果这个sql没有被设置值
        if(!isset($sql))
        {
            die("没有为查询sql赋值");
        }
        //执行sql语句得到结果集
        $this->result = mysqli_query($this->mysqli, $sql);

        if(!$this->result)
        {
            die("sql语句执行失败:".$sql);
        }

        //把循环结果放到一个数组中
        $arr = array();
        //读取一条记录(是一个一维数组)，
        while($row = mysqli_fetch_array($this->result))
        {
                //向数组中添加每一行的内容
                $arr[] = $row;
        }
        //得到的是一个二维数组,返回二维数组
        return $arr;
    }

    /**
     * 
     * 专门用于执行按主键查询或只有一条记录查询
     * @param $sql:select 语句.如：select * from 表 where id=1 
     */
    public function query_list_id($sql)
    {
        //如果这个sql没有被设置值
        if(!isset($sql))
        {
            die("没有为要查询的sql语句赋值");
        }
        //执行sql语句得到结果集
        $this->result = mysqli_query($this->mysqli, $sql);

        if(!$this->result)
        {
            die("sql语句执行失败".$sql);
        }
        //因为只有一条记录  所以不需要循环
        $row = mysqli_fetch_array($this->result);
        //返回一维数组
        return $row;
    }
    /**
     * 
     * 专门用于添删改:insert,delete,update语句
     * @param sql:insert,delete,update语句
     */
    public function edit_list($sql)
    {
        //如果这个sql没有被设置值
        if(!isset($sql))
        {
           die("没有为有执行添、删、改的sql语句赋值");
        }
        //执行:insert,delete,update语句
        $i=mysqli_query($this->mysqli, $sql);//有返回值.真,假,真成功.
        if(!$i)
        {
            die("sql语句执行失败:".$sql);
        }
		return mysqli_affected_rows($this->mysqli);
    }
    /**
     * 
     * 总记录数:
     * @param $sql:select count(*) from users
     */
    public function record_count($sql)
    {
        //如果这个sql没有被设置值
        if(!isset($sql))
        {
            die("没有为要查询统计总记录数的sql语句赋值");
        }
        //执行sql语句得到结果集
        $this->result = mysqli_query($this->mysqli, $sql);

        if(!$this->result)
        {
            die("sql语句执行失败:".$sql);
        }
        //查询结果只有一条记录(不需要循环)。一行一列
        $row=mysqli_fetch_array($this->result);
        //
        return  $row[0];
    }
    //总页数=总记录数%每页大小==0?总记录数/每页大小:(int)(总记录数/每页大小)+1;
    /**
     * 
     * 总页数=总记录数%每页大小==0?总记录数/每页大小:(int)(总记录数/每页大小)+1;
     * @param $sql:select count(*) from users
     * @param $page:每页大小
     */
    public  function page_count($sql,$page)
    {
        return 	$this->record_count($sql)%$page==0?
                $this->record_count($sql)/$page:
            (int)($this->record_count($sql)/$page)+1;
    }
    //分页:select a.*,b.departname from users a,depart b where a.departid=b.departid  limit 25,5
    //分页:select * from users    limit 25,5 #第6页
    /**
     * 
     * 查询分页
     * @param  $sql:格式:select * from users  或select a.*,b.departname from users a,depart b where a.departid=b.departid 
     * @param  $current:当前页
     * @param  $page:每页大小
     */
    public  function paging($sql,$current,$page)
    {
        //分页格式:select * from users limit (n-1)*每页大小,每页大小 #n表示当前页
        //如果这个sql没有被设置值
        if(!isset($sql))
        {
            die("没有为要查询分页的sql语句赋值");
        }
        //拼select语句:格式:select * from users    limit 25,5
        $sql.=" limit ".  ($current-1)*$page ."," .$page;
        //echo $sql;
        //执行sql语句得到结果集
        $this->result = mysqli_query($this->mysqli, $sql);
        if(!$this->result)
        {
            die("sql语句执行失败:".$sql);
        }
        //把循环结果放到一个数组中
        $arr = array();
        //读取一条记录(是一个一维数组)，
        while($row = mysqli_fetch_array($this->result))
        {
                //向数组中添加每一行的内容
                $arr[] = $row;
        }
        //得到的是一个二维数组,返回二维数组
        return $arr;
    }
    //关闭数据库  在程序运行结束的时候会触发析构方法
    //析构函数:自动调用.用来连接数据为时释放资源的
    public function __destruct()
    {
        $mysqli=$this->mysqli();
        if($this->mysqli)
            mysqli_close($mysqli); 
    }
}