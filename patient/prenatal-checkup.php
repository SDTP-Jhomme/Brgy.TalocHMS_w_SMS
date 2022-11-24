<div class="w-90 lg">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Prenatal Checkup Request Form</h3>
            <el-main>
                <el-form :model="prenatal" :rules="prenatalRules" ref="prenatal">
                    <div>
                        <el-divider></el-divider>
                    </div>
                    <div class="">
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for="">Spouse First Name :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="spouseFname">
                                    <el-input size="medium" v-model="prenatal.spouseFname" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Spouse Last Name :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="spouseLname">
                                    <el-input size="medium" v-model="prenatal.spouseLname" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Address : Purok</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="purok">
                                    <el-input size="medium" v-model="prenatal.purok" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Barangay :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="barangay">
                                    <el-input size="medium" v-model="prenatal.barangay" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>