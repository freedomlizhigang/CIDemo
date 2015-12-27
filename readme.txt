项目规划

|-app  项目功能文件夹(参考CI手册)
	|- config 系统配置文件
		|-publicpath.php 静态资源路径配置
	|-controllers  控制器
		|-mzsj  后台功能控制器
	|-core
		|-MY_Model.php  扩展了系统数据库操作类的一些常用操作，改为insertOne，getAll等
	|-models  模型
	|-helpers 常用函数
		|-global_helper.php
	|-views  视图模板
	|-libraries 常用类库
		|-updatecache 缓存更新类
		|-MY_form_validation.php 扩展系统的验证类
	|-cache  数据缓存文件夹（更改了系统cache_file类的保存参数，文件权限改为644，原为640）
	|-app.php 
		自己定义一的些内容，要引入到项目入口index.php中，如：定义了一个加载类的函数（担心升级的影响所以没有放到系统中）
|-core  CI核心类库

|-public  公用静态文件
	|-css
	|-js
	|-images
	|-font

|-uploads  上传文件存储位置

|-index.php   项目入口文件


