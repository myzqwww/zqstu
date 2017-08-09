<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./static/bt3/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top: 10px;" >
    <a href="./index.php" class="btn btn-default">返回首页</a>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">详细信息</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>姓名</th>
                    <th>头像</th>
                    <th>性别</th>
                    <th>班级</th>
                    <th>生日</th>
                    <th>爱好</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ( $data as $k => $d ): ?>
                    <tr>
                        <td><?php echo $k+1; ?></td>
                        <td><?php echo $d['sname'] ?></td>
                        <td>
                            <img src="<?php echo $d['profile'] ?>" width="80">
                        </td>
                        <td><?php echo $d['sex'] ?></td>
                        <td><?php echo $d['gname'] ?></td>
                        <th><?php echo $d['birthday'] ?></th>
                        <th><?php echo $d['hobby'] ?></th>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>