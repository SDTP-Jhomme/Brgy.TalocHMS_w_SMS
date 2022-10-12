<div>
    <el-container>
        <el-header height="0px"></el-header>
        <el-main v-if="active == 0">
            <el-row class="mb-3">
                <el-col :span="12" :offset="2">
                    Patient Information
                </el-col>
            </el-row>
            <el-form :model="addPatient" :rules="addRules" ref="addPatient">
                <el-row :gutter="20" type="flex" justify="center">
                    <el-col :span="6">
                        <el-form-item prop="lastName">
                            <label class="m-0"><span class="text-danger">*</span> Last Name</label>
                            <el-input v-model="addPatient.lastName" clearable></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="6">
                        <el-form-item prop="firstName">
                            <label class="m-0"><span class="text-danger">*</span> First Name</label>
                            <el-input v-model="addPatient.firstName" clearable></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="6">
                        <el-form-item prop="middleName">
                            <label class="m-0">Middle Name</label>
                            <el-input v-model="addPatient.middleName" clearable></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="2">
                        <el-form-item prop="suffix">
                            <label class="m-0">Suffix</label>
                            <el-input v-model="addPatient.suffix" clearable></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="30" type="flex" justify="center" align="middle">
                    <el-col :span="6">
                        <el-form-item prop="birthDate">
                            <label class="m-0 d-block"><span class="text-danger">*</span> Birthdate</label>
                            <el-date-picker v-model="addPatient.birthDate" type="date" placeholder="">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :span="6">
                        <el-form-item prop="gender">
                            <label class="m-0"><span class="text-danger">*</span> Gender</label>
                            <div>
                                <el-radio v-model="addPatient.gender" label="Male">Male</el-radio>
                                <el-radio v-model="addPatient.gender" label="Female">Female</el-radio>
                            </div>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <el-divider></el-divider>
        </el-main>
        <el-main v-if="active == 1">
            <el-row class="mb-3">
                <el-col :span="12" :offset="2">
                    Select Checkup
                </el-col>
            </el-row>
            <el-row :gutter="40" type="flex" justify="center">
                <el-col :span="5">
                    <div>
                        <a href="javascript:void(0)" @click="healthCheckup">
                            <div class="card card-overflow-hidden health-checkup" :class="{'card-border-health': this.isHealthCheckup}">
                                <img src="../assets/img/health-checkup.png" alt="Health Checkup">
                                <div :class="this.isHealthCheckup ? 'card-with-hover-active' : 'card-with-hover'">
                                    <div class="card-text-center">
                                        <h4 class="text-center">Health Checkup</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </el-col>
                <el-col :span="5">
                    <div>
                        <a href="javascript:void(0)" @click="immunization">
                            <div class="card card-overflow-hidden immunization-checkup" :class="{'card-border-immunization': this.isImmunization}">
                                <img src="../assets/img/immunization.png" alt="Immunization Checkup">
                                <div :class="this.isImmunization ? 'card-with-hover-active' : 'card-with-hover'">
                                    <div class="card-text-center">
                                        <h4 class="text-center">Immunization Checkup</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </el-col>
                <el-col :span="5">
                    <div>
                        <a href="javascript:void(0)" @click="pregnancy">
                            <div class="card card-overflow-hidden pregnancy-checkup" :class="{'card-border-pregnancy': this.isPregnancy}">
                                <img src="../assets/img/pregnancy.png" alt="Pregnancy Checkup">
                                <div :class="this.isPregnancy ? 'card-with-hover-active' : 'card-with-hover'">
                                    <div class="card-text-center">
                                        <h4 class="text-center">Pregnancy Checkup</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </el-col>
            </el-row>
        </el-main>
        <el-main v-if="active == 2">
            <el-row class="mb-3">
                <el-col :span="12" :offset="2">
                    Fill in the Forms
                </el-col>
            </el-row>
            <el-row v-if="this.isHealthCheckup" :gutter="30" type="flex" justify="center">
                Health Checkup
            </el-row>
            <el-row v-if="this.isImmunization" :gutter="30" type="flex" justify="center">
                Immunization
            </el-row>
            <el-row v-if="this.isPregnancy" :gutter="30" type="flex" justify="center">
                <?php include("./prenatal-checkup.php"); ?>
            </el-row>
        </el-main>
        <el-main>
            <el-row type="flex" justify="center" class="mt-4 mb-4">
                <el-col>
                    <el-steps :space="800" :active="active" finish-status="success" align-center>
                        <el-step title="Step 1"></el-step>
                        <el-step title="Step 2"></el-step>
                        <el-step title="Finish"></el-step>
                    </el-steps>
                </el-col>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 0">
                <el-button type="primary" size="small" plain @click="proceed('addPatient')">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 1">
                <el-button-group>
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="next">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                </el-button-group>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 2">
                <el-button-group>
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submit">Submit</i></el-button>
                </el-button-group>
            </el-row>
        </el-main>
    </el-container>
</div>