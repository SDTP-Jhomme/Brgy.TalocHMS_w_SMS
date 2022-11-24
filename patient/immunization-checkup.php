<div class="w-90 lg">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Immunization Checkup Request Form</h3>
            <el-main>
                <div>
                    <el-divider></el-divider>
                </div>
                <el-form :model="immunize" :rules="immunizationRules" ref="immunize">
                    <div class="row g-3 align-items-center mt-5">
                        <div class="col-auto mb-4">
                            <label for=""><span class="text-danger">*</span>Mother Last Name :</label>
                        </div>
                        <div class="col-2 mb-4">
                            <el-form-item prop="mLastName">
                                <el-input v-model="immunize.mLastName" clearable></el-input>
                            </el-form-item>
                        </div>
                        <div class="col-auto mb-4">
                            <label for=""><span class="text-danger">*</span>Mother First Name :</label>
                        </div>
                        <div class="col-2 mb-4">
                            <el-form-item prop="mFirstName">
                                <el-input v-model="immunize.mFirstName" clearable></el-input>
                            </el-form-item>
                        </div>
                        <div class="col-auto mb-4">
                            <label for="">Mother Middle Name :</label>
                        </div>
                        <div class="col-2 mb-4">
                            <el-form-item prop="mMidName">
                                <el-input v-model="immunize.mMidName" clearable></el-input>
                            </el-form-item>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mt-5">
                        <div class="col-auto mb-4 mb-4">
                            <label for=""><span class="text-danger">*</span>Father Last Name :</label>
                        </div>
                        <div class="col-2 mb-4">
                            <el-form-item prop="fLastName">
                                <el-input v-model="immunize.fLastName" clearable></el-input>
                            </el-form-item>
                        </div>
                        <div class="col-auto mb-4">
                            <label for=""><span class="text-danger">*</span>Father First Name :</label>
                        </div>
                        <div class="col-2 mb-4">
                            <el-form-item prop="fFirstName">
                                <el-input v-model="immunize.fFirstName" clearable></el-input>
                            </el-form-item>
                        </div>
                        <div class="col-auto mb-4">
                            <label for=""><span class="text-danger">*</span>Father Middle Name :</label>
                        </div>
                        <div class="col-2 mb-4">
                            <el-form-item prop="fMidName">
                                <el-input v-model="immunize.fMidName" clearable></el-input>
                            </el-form-item>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mt-5">
                        <div class="col-auto mb-4">
                            <label for=""><span class="text-danger">*</span>Address :(Purok)</label>
                        </div>
                        <div class="col-4 mb-4">
                            <el-form-item prop="purok">
                                <el-input v-model="immunize.purok" clearable></el-input>
                            </el-form-item>
                        </div>
                        <div class="col-auto mb-4">
                            <label for=""><span class="text-danger">*</span>Barangay :</label>
                        </div>
                        <div class="col-4 mb-4">
                            <el-form-item prop="barangay">
                                <el-input v-model="immunize.barangay" clearable></el-input>
                            </el-form-item>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>