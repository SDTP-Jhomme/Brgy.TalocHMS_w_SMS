<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <header class="masthead bg-primary-2 text-white text-center">
                <div class="container d-flex align-items-center flex-column">
                    <!-- Masthead Avatar Image-->
                    <img class="masthead-avatar mb-5 rounded-circle" :src="this.avatar" alt="<?php echo $name; ?>" />
                    <!-- Masthead Heading-->
                    <h1 class="masthead-heading text-uppercase mb-0"><?php echo $name; ?></h1>
                    <!-- Icon Divider-->
                    <div class="divider-custom divider-light">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                        <div class="divider-custom-line"></div>
                    </div>
                    <!-- Masthead Subheading-->
                    <p class="masthead-subheading font-weight-light mb-0">FSN : <?php echo $db_identification; ?></p>
                </div>
            </header>
        </div>
        <div class="carousel-item">
            <div>
                <el-container>
                    <el-header height="0px"></el-header>
                    <el-main v-if="active == 0">
                        <el-row class="mb-3">
                            <el-col :span="12" :offset="2">
                                Select Checkup
                            </el-col>
                        </el-row>
                        <el-row :gutter="40" class="d-flex flex-wrap justify-content-evenly">
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
                            <el-col v-if="this.gender == 'Female'" :span="5">
                                <div :class="this.isHealthCheckup && !this.isImmunization || !this.isHealthCheckup && this.isImmunization ? 'w-30' : this.isHealthCheckup && this.isImmunization ? 'w-20' : 'w-25'">
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
                        <header class="masthead bg-primary-2 text-white text-center">
                            <div class="container d-flex align-items-center flex-column">
                                <!-- Masthead Avatar Image-->
                                <img class="masthead-avatar mb-5 rounded-circle" :src="this.avatar" alt="<?php echo $name; ?>" />
                                <!-- Masthead Heading-->
                                <h1 class="masthead-heading text-uppercase mb-0"><?php echo $name; ?></h1>
                                <!-- Icon Divider-->
                                <div class="divider-custom divider-light">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Masthead Subheading-->
                                <p class="masthead-subheading font-weight-light mb-0">Your requested form has been added successfully!</p>
                            </div>
                        </header>
                    </el-main>

                    <el-main>
                        <el-row type="flex" justify="center" class="mt-4 mb-4">
                            <el-col>
                                <el-steps :space="800" :active="active" finish-status="success" align-center>
                                    <el-step title="Step 1" icon="el-icon-thumb"></el-step>
                                    <el-step title="Finish" icon="el-icon-edit"></el-step>
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
                            <el-button type="primary" size="small" plain @click="submit">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                        </el-row>
                    </el-main>
                </el-container>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>