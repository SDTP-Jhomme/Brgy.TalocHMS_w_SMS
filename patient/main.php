<div id="carouselExampleControlsNoTouching" class="carousel carousel-dark slide" data-bs-touch="false" data-bs-interval="false">
    <div class="carousel-indicators my-5">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
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
                    <el-main>
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
                            <el-col v-if="this.age >= '12'" :span="5">
                                <div>
                                    <a href="javascript:void(0)" @click="family">
                                        <div class="card card-overflow-hidden family-checkup" :class="{'card-border-family': this.isFamily}">
                                            <img src="../assets/img/family-planning.png" alt="Family Planning Checkup">
                                            <div :class="this.isFamily ? 'card-with-hover-active' : 'card-with-hover'">
                                                <div class="card-text-center">
                                                    <h4 class="text-center">Family Planning</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </el-col>
                        </el-row>
                    </el-main>
                    <el-main>
                        <el-row type="flex" justify="center" v-if="active == 0">
                            <el-button v-if="isHealthCheckup" type="primary" size="small" plain @click="nextHealth('health')">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                            <el-button v-else-if="isImmunization" type="primary" size="small" plain @click="nextImmunize('immunize')">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                            <el-button v-else-if="isPregnancy" type="primary" size="small" plain @click="nextPrenatal('maternal')">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                            <el-button v-else type="primary" size="small" plain @click="nextFamily('fam_planning')">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                        </el-row>
                    </el-main>
                </el-container>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>