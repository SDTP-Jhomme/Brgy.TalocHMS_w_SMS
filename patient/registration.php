<div>
    <el-container>
        <el-header height="0px"></el-header>
        <el-main v-if="active == 0">
            <el-row class="mb-3">
                <el-col :span="12" :offset="2">
                    Select Checkup
                </el-col>
            </el-row>
            <el-row :gutter="40" type="flex" justify="center">
                <el-col :span="5">
                    <div class="block">
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
                    <div class="block">
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
                    <div class="block">
                        <a href="javascript:void(0)" v-if="viewPatient.gender = 'Female'" @click="pregnancy">
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
        <el-main v-if="active == 1">
            <el-row class="mb-4">
            </el-row>
            <el-row v-if="this.isHealthCheckup" :gutter="30" type="flex" justify="center">
                <?php include("./health-checkup.php"); ?>
            </el-row>
            <el-row v-if="this.isImmunization" :gutter="30" type="flex" justify="center">
                <?php include("./immunization-checkup.php"); ?>
            </el-row>
            <el-row v-if="this.isPregnancy" :gutter="30" type="flex" justify="center">
                <?php include("./prenatal-checkup.php"); ?>
            </el-row>
        </el-main>
        <el-main v-if="active == 2">

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
                <el-button-group v-if="isHealthCheckup">
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitHealth('health')">Submit</i></el-button>
                </el-button-group>
                <el-button-group v-else-if="isImmunization">
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitImmunization('immunize')">Submit</i></el-button>
                </el-button-group>
                <el-button-group v-else>
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitPrenatal('prenatal')">Submit</i></el-button>
                </el-button-group>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 2">
                <el-button-group>
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="addUser('addSms')">Send <i class="el-icon-s-promotion"></i></el-button>
                </el-button-group>
            </el-row>
        </el-main>
    </el-container>
</div>