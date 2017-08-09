<?php include './view/admin/header.php' ?>
<div class="container">
    <div class="row">
		<?php include './view/admin/left.php' ?>
        <div class="col-xs-9">
            <a href="?s=admin/student/lists" class="btn btn-default">列表</a>
            <a href="?s=admin/student/store" class="btn btn-primary">添加</a>
            <hr>
            <form action="" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputID">学生姓名:</label>
                    <input type="text" name="sname" id="inputID" class="form-control" value="" title=""
                           required="required">
                </div>
                <div class="form-group">
                    <label for="inputID">所属班级:</label>
                    <div >
                        <select name="gid" id="inputID" class="form-control" required>
                            <option value=""> -- 请选择 --</option>
                            <?php foreach($gradeData as $g): ?>
                                <option value="<?php echo $g['gid'] ?>"> <?php echo $g['gname'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">

                    <label for="">头像：</label>
                    <hr>
                    <?php foreach($materialData as $m): ?>
                        <img class="profile" src="<?php echo $m['path'] ?>" width="80">
                    <?php endforeach ?>
                    <script>
                        $(function(){
                            $('.profile').click(function(){
                                $(this).css({border:'2px solid red'}).siblings('img').css({border:'none'});
                                $('[name=profile]').val($(this).attr('src'));
                            })
                        })
                    </script>
                    <input type="hidden" name="profile">
                </div>
                <div class="form-group">
                    <label for="inputID">性别:</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex" id="inputID" value="男" checked="checked">
                            男
                        </label>
                        <label>
                            <input type="radio" name="sex" id="inputID" value="女">
                            女
                        </label>
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputID">生日:</label>
                    <input type="date" name="birthday" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputID">爱好:</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="篮球" name="hobby[]">
                            篮球
                        </label>
                        <label>
                            <input type="checkbox" value="足球"  name="hobby[]">
                            足球
                        </label>
                        <label>
                            <input type="checkbox" value="乒乓球"  name="hobby[]">
                            乒乓球
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">添加</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>