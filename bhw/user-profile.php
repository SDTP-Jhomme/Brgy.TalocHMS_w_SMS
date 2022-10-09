<el-container>
    <el-header height="0px"></el-header>
    <el-main>
        <el-row class="mb-3">
            <el-col :span="12" :offset="2">
                <h3>Profile</h3>
            </el-col>
        </el-row>
        <el-row :gutter="30" class="mb-3" type="flex" justify="center">
            <el-col :span="6">
                <div class="card profile shadow">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img :src="this.avatar" alt="Profile" class="rounded-circle mb-3">
                        <h4><?php echo $name; ?></h4>
                        <p>Barangay Health Worker</p>
                    </div>
                </div>
            </el-col>
            <el-col :span="12">
                <div class="card p-4 shadow">
                    <el-tabs>
                        <el-tab-pane>
                            <span slot="label">
                                <h5><i class="el-icon-document"></i> User Profile Info</h5>
                            </span>
                            <?php include("./profile-info.php"); ?>
                        </el-tab-pane>
                        <el-tab-pane>
                            <span slot="label">
                                <h5><i class="el-icon-lock"></i> Change Password</h5>
                            </span>
                            <?php include("./update-pass.php"); ?>
                        </el-tab-pane>
                    </el-tabs>
                </div>
            </el-col>
        </el-row>
    </el-main>
</el-container>