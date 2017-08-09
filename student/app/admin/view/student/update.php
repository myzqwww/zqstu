<?php include './view/admin/header.php' ?>
<div class="container">
    <div class="row">
		<?php include './view/admin/left.php' ?>
        <div class="col-xs-9">
            <a href="?s=admin/student/lists" class="btn btn-default">列表</a>
            <a href="?s=admin/student/store" class="btn btn-default">添加</a>
            <hr>
            <form action="" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputID">学生姓名:</label>
                    <input type="text" name="sname" id="inputID" class="form-control" value="<?php echo $oldData['sname'] ?>" title=""
                           required="required">
                </div>
                <div class="form-group">
                    <label for="inputID">所属班级:</label>
                    <div >
                        <select name="gid" id="inputID" class="form-control" required>
                            <option value=""> -- 请选择 --</option>
                            <?php foreach($gradeData as $g): ?>
                                <option value="<?php echo $g['gid'] ?>" <?php if($oldData['gid'] == $g['gid']): ?> selected <?php endif ?>  > <?php echo $g['gname'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">

                    <label for="">头像：</label>
                    <hr>
                    <?php foreach($materialData as $m): ?>
                        <img class="profile" src="<?php echo $m['path'] ?>" width="80"  <?php if($oldData['profile'] == $m['path']): ?> style="border: 2px solid red" <?php endif ?> >
                    <?php endforeach ?>
                    <script>
                        $(function(){
                            $('.profile').click(function(){
                                $(this).css({border:'2px solid red'}).siblings('img').css({border:'none'});
                                $('[name=profile]').val($(this).attr('src'));
                            })
                        })
                    </script>
<!--                    保存头像的隐藏域-->
                    <input type="hidden" name="profile" value="<?php echo $oldData['profile'] ?>">
                </div>
                <div class="form-group">
                    <label for="inputID">性别:</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex" id="inputID" value="男" <?php if($oldData['sex'] == '男'): ?> checked="checked" <?php endif ?> >
                            男
                        </label>
                        <label>
                            <input type="radio" name="sex" id="inputID" value="女" <?php if($oldData['sex'] == '女'): ?> checked="checked" <?php endif ?>>
                            女
                        </label>
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputID">生日:</label>
                    <input type="date" name="birthday" class="form-control" value="<?php echo $oldData['birthday'] ?>">
                </div>
                <div class="form-group">
                    <label for="inputID">爱好:</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="篮球" name="hobby[]" <?php if(in_array('篮球',$oldData['hobby'])): ?>checked<?php endif ?> >
                            篮球
                        </label>
                        <label>
                            <input type="checkbox" value="足球" name="hobby[]" <?php if(in_array('足球',$oldData['hobby'])): ?>checked<?php endif ?> >

                            足球
                        </label>
                        <label>
                            <input type="checkbox" value="乒乓球" name="hobby[]" <?php if(in_array('乒乓球',$oldData['hobby'])): ?>checked<?php endif ?> >

                            乒乓球
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">修改</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>