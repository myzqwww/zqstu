<?php include './view/admin/header.php' ?>
<div class="container">
    <div class="row">
		<?php include './view/admin/left.php' ?>
        <div class="col-xs-9">
            <a href="?s=admin/material/lists" class="btn btn-primary">列表</a>
            <a href="?s=admin/material/store" class="btn btn-default">添加</a>
            <hr>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>图像</th>
                    <th>素材</th>
                    <th>上传时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach ( $data as $k => $v ): ?>
                    <tr>
                        <td><?php echo $k+1 ?></td>
                        <td>
                            <img src="<?php echo $v['path'] ?>" width="70">
                        </td>
                        <td><?php echo $v['path'] ?></td>
                        <td><?php echo date('y-m-d H:i:s',$v['create_time']) ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="javascript:if(confirm('确定删除吗？')) location.href='?s=admin/material/remove&mid=<?php echo $v['mid'] ?>';" class="btn btn-xs btn-danger">删除</a>
                            </div>
                        </td>
                    </tr>
				<?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>