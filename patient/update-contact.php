<div>
    <el-row :gutter="20" class="mt-3" v-if="!checkContact">
        <el-col>
            <label class="form-label mb-0" for=""><span class="text-danger">*</span> Current Phone Number</label>
            <el-input placeholder="Enter Current Phone Number" maxlength="11" v-model="currentContact" show-phone_number></el-input>
            <span class="text-danger">{{this.currentContactErr}}</span>
        </el-col>
    </el-row>
    <div v-else>
        <el-row :gutter="20" class="mt-3">
            <el-col>
                <label class="form-label mb-0" for=""><span class="text-danger">*</span> Input New Phone Number</label>
                <el-input placeholder="" v-model="newContact" maxlength="11" show-phone_number></el-input>
                <span class="text-danger">{{this.newContactErr}}</span>
            </el-col>
        </el-row>
        <el-row :gutter="20" class="mt-3">
            <el-col>
                <label class="form-label mb-0" for=""><span class="text-danger">*</span> Confirm Phone Number</label>
                <el-input placeholder="" v-model="confirmContact" maxlength="11" show-phone_number></el-input>
                <span class="text-danger">{{this.confirmContactErr}}</span>
            </el-col>
        </el-row>
    </div>
    <el-row :gutter="20" class="mt-5 mb-5">
        <el-col v-if="checkContact">
            <button class="btn btn-primary" v-if="loadButton" disabled><i class="el-icon-loading"></i> Loading</button>
            <button class="btn btn-primary" v-else @click="updateContact">Update Phone Number</button>
            <button class="btn btn-secondary" @click="resetContact">Reset Form</button>
        </el-col>
        <el-col v-else>
            <button type="button" class="btn btn-primary" @click="checkContactNo">Submit</button>
        </el-col>
    </el-row>
</div>