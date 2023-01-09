<div>
    <label class="form-label mb-0" for="">Change Avatar</label>
    <el-row type="flex" v-if="fileImg" justify="center">
        <div class="mb-3 mt-2 avatar-container d-flex card-overflow-hidden">
            <img :src="fileUrl" class="avatar">
            <div class="avatar-overlay">
                <span class="hover-remove-avatar">
                    <i class="el-icon-delete" @click="removeAvatar"></i>
                </span>
            </div>
        </div>
    </el-row>
    <el-row type="flex" v-if="fileImg" justify="center">
        <button class="btn btn-primary" class="form-control" v-if="loadButton" disabled><i class="el-icon-loading"></i> Uploading</button>
        <button class="btn btn-primary" class="form-control" @click="submitFile" v-else>Upload</button>
    </el-row>
    <el-row :gutter="20" v-else>
        <el-col :span="12">
            <input type="file" ref="file" class="form-control" @change="fileUpload" />
        </el-col>
    </el-row>
    <el-row :gutter="20" class="mt-3">
        <el-col>
            <label class="form-label mb-0" for="">Name</label>
            <input type="text" class="form-control" value="<?php echo $name; ?>" disabled />
        </el-col>
    </el-row>
    <el-row :gutter="20" class="mt-3">
        <el-col :span="16">
            <label class="form-label mb-0" for="">Birthday</label>
            <input type="text" class="form-control" value="<?php echo $db_birthday; ?>" disabled />
        </el-col>
        <el-col :span="8">
            <label class="form-label mb-0" for="">Gender</label>
            <input type="text" class="form-control" value="<?php echo $db_gender; ?>" disabled />
        </el-col>
    </el-row>
    <el-row :gutter="20" class="mt-3 mb-5">
        <el-col>
            <label class="form-label mb-0" for="">Phone No</label>
            <input type="text" class="form-control" value="<?php echo $db_contact; ?>" disabled />
        </el-col>
    </el-row>
</div>