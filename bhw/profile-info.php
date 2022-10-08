<div>
    <label class="form-label mb-0" for="">Change Avatar</label>
    <el-row :gutter="20">
        <el-col :span="18">
            <input type="file" class="form-control" />
        </el-col>
        <el-col :span="4">
            <input class="btn btn-primary" type="submit" class="form-control" value="Upload" />
        </el-col>
    </el-row>
    <el-row :gutter="20" class="mt-3">
        <el-col>
            <label class="form-label mb-0" for="">Identification No.</label>
            <input type="text" class="form-control" value="<?php echo $db_identification; ?>" disabled />
        </el-col>
    </el-row>
    <el-row :gutter="20" class="mt-3">
        <el-col>
            <label class="form-label mb-0" for="">Name</label>
            <input type="text" class="form-control" value="<?php echo $name; ?>" disabled />
        </el-col>
    </el-row>
    <el-row :gutter="20" class="mt-3 mb-5">
        <el-col :span="16">
            <label class="form-label mb-0" for="">Birthday</label>
            <input type="text" class="form-control" value="<?php echo $db_birthday; ?>" disabled />
        </el-col>
        <el-col :span="8">
            <label class="form-label mb-0" for="">Gender</label>
            <input type="text" class="form-control" value="<?php echo $db_gender; ?>" disabled />
        </el-col>
    </el-row>
</div>