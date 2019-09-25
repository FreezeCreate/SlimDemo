# Slim4使用手册 #

----------

# 环境配置 #

- 请务必composer slim4核心类库、slim http、psr三方包。
- 请务必配置虚拟域名并隐藏index.php
- 如果是原生应用，请遵循规范在public目录下定义入口文件index.php


#  使用规范 #
- 初始化引用autoload.php
- 路由方式get()、post()等
- ->run()定义运行