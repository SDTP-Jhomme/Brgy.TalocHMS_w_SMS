<div>
    <el-container>
        <el-header height="0px"></el-header>
        <el-main v-if="active == 0" class="slide-in">
            <el-row class="mb-3">
                <el-col :span="12" :offset="2">
                    Select Checkup
                </el-col>
            </el-row>
            <el-row :gutter="40" type="flex" justify="center">
                <el-col :span="5">
                    <div>
                        <a href="javascript:void(0)" @click="healthCheckup">
                            <div class="card card-overflow-hidden health-checkup" :class="{'card-border-health': this.checkupType == 'isHealthCheckup'}">
                                <img src="../assets/img/health-checkup.png" alt="Health Checkup">
                                <div :class="this.checkupType == 'isHealthCheckup' ? 'card-with-hover-active' : 'card-with-hover'">
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
                            <div class="card card-overflow-hidden immunization-checkup" :class="{'card-border-immunization': this.checkupType == 'isImmunization'}">
                                <img src="../assets/img/immunization.png" alt="Immunization Checkup">
                                <div :class="this.checkupType == 'isImmunization' ? 'card-with-hover-active' : 'card-with-hover'">
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
                            <div class="card card-overflow-hidden pregnancy-checkup" :class="{'card-border-pregnancy': this.checkupType == 'isPregnancy' && this.checkupType}">
                                <img src="../assets/img/pregnancy.png" alt="Pregnancy Checkup">
                                <div :class="this.checkupType == 'isPregnancy' && this.checkupType ? 'card-with-hover-active' : 'card-with-hover'">
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
        <el-main v-if="active == 1" class="slide-in">
            <el-row class="mb-3">
                <el-col :span="12" :offset="2">
                    <span v-if="this.checkupType == 'isHealthCheckup'">Individual Treatment</span><span v-if="this.checkupType == 'isImmunization'">Immunization</span><span v-if="this.checkupType == 'isPregnancy'">Prenatal</span> Patient Information
                </el-col>
            </el-row>
            <el-form :model="addPatient" :rules="addRules" ref="addPatient">
                <el-row :gutter="20" type="flex" justify="center">
                    <el-col :offset="this.checkupType != 'isPregnancy' ? 16 : 14" :span="4">
                        <el-form-item prop="fsn">
                            <label class="m-0"><span class="text-danger">*</span> FSN</label>
                            <el-input v-model="addPatient.fsn" clearable></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
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
                    <el-col :span="2" v-if="this.checkupType != 'isPregnancy'">
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
                            <el-date-picker :picker-options="this.maxDate" v-model="addPatient.birthDate" type="date" placeholder="">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :span="6" v-if="this.checkupType != 'isPregnancy'">
                        <el-form-item prop="gender">
                            <label class="m-0"><span class="text-danger">*</span> Gender</label>
                            <div>
                                <el-radio v-model="addPatient.gender" label="Male">Male</el-radio>
                                <el-radio v-model="addPatient.gender" label="Female">Female</el-radio>
                            </div>
                        </el-form-item>
                    </el-col>
                    <el-col :span="5">
                        <el-form-item prop="phone">
                            <label class="m-0"><span class="text-danger">*</span> Phone Number</label>
                            <el-input v-model="addPatient.phone" clearable></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <el-divider></el-divider>
        </el-main>
        <el-main v-if="active == 2" class="slide-in">
            <el-row class="mb-4">
            </el-row>
            <el-row v-if="this.checkupType == 'isHealthCheckup'" :gutter="30" type="flex" justify="center">
                <?php include("./checkups/health-checkup.php"); ?>
            </el-row>
            <el-row v-if="this.checkupType == 'isImmunization'" :gutter="30" type="flex" justify="center">
                Immunization
            </el-row>
            <el-row v-if="this.checkupType == 'isPregnancy'" :gutter="30" type="flex" justify="center">
                <?php include("./checkups/prenatal-checkup.php"); ?>
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
                <el-button type="primary" size="small" plain @click="next">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 1">
                <el-button-group>
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="proceed('addPatient')">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                </el-button-group>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 2">
                <el-button-group v-if="this.checkupType == 'isHealthCheckup'">
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitHealth">Submit <i class="el-icon-caret-right"></i></el-button>
                </el-button-group>
                <el-button-group v-else-if="this.checkupType == 'isImmunization'">
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitImmunization">Submit <i class="el-icon-caret-right"></i></el-button>
                </el-button-group>
                <el-button-group v-else>
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitPrenatal('prenatal')">Submit <i class="el-icon-caret-right"></i></el-button>
                </el-button-group>
            </el-row>
        </el-main>
    </el-container>
</div>