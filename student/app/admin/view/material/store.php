<?php include './view/admin/header.php' ?>
<div class="container">
    <div class="row">
		<?php include './view/admin/left.php' ?>
        <div class="col-xs-9">
            <a href="?s=admin/material/lists" class="btn btn-default">列表</a>
            <a href="?s=admin/material/store" class="btn btn-primary">添加</a>
            <hr>
            <form action="" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputID">上传素材:</label>
                    <input type="file" name="upload" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>