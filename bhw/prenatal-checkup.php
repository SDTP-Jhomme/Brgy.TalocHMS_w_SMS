<div class="w-60 lg">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Prenatal Checkup Form</h3>
            <el-main>
                <el-form :model="prenatal" :rules="prenatalRules" ref="prenatal">

                    <!-- Patient Information -->
                    <div class="label-format d-flex flex-wrap justify-content-around">
                        <div class="w-25 mb-4">
                            <label class="m-0">First Name</label>
                            <el-input v-model="addPatient.firstName" size="small" clearable disabled></el-input>
                        </div>
                        <div class="w-25 mb-4">
                            <label class="m-0">Last Name</label>
                            <el-input v-model="addPatient.lastName" size="small" clearable disabled></el-input>
                        </div>
                        <div class="w-25 mb-4" v-if="addPatient.middleName">
                            <label class="m-0">Middle Name</label>
                            <el-input v-model="addPatient.middleName" size="small" clearable disabled></el-input>
                        </div>
                        <div class="mb-4 d-flex flex-wrap justify-content-between" :class="addPatient.middleName ? 'w-50' : 'w-40'">
                            <div :class="addPatient.middleName ? 'w-50' : 'w-60'">
                                <label class="m-0">Birthdate</label>
                                <el-date-picker v-model="addPatient.birthDate" type="date" size="small" placeholder="" disabled>
                                </el-date-picker>
                            </div>
                            <div :class="addPatient.middleName ? 'w-30' : 'w-35'">
                                <label class="m-0">Gender</label>
                                <el-input v-model="addPatient.gender" size="small" clearable disabled></el-input>
                            </div>
                        </div>
                    </div>
                    <!-- End -->

                    <div>
                        <el-divider></el-divider>
                    </div>
                    <div class="underline-input">
                        <div class="mt-5 d-flex flex-wrap justify-content-around">
                            <div class="w-35 mb-4">
                                <el-form-item label="Appointment Date" prop="appointment">
                                    <el-input size="medium" v-model="prenatal.appointment" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Date of Prenatal Visit" prop="dateVisit">
                                    <el-date-picker size="medium" v-model="prenatal.dateVisit" type="date" placeholder="Select Date">
                                    </el-date-picker>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Weight" prop="weight">
                                    <el-input size="medium" v-model="prenatal.weight" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Blood Pressure" prop="blood">
                                    <el-input size="medium" v-model="prenatal.blood" clearable>
                                        <template slot="suffix">mmHg</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="AOG" prop="aog">
                                    <el-input size="medium" v-model="prenatal.aog" clearable>
                                        <template slot="suffix">weeks</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Fundic Height" prop="height">
                                    <el-input size="medium" v-model="prenatal.height" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="FHB" prop="fhb">
                                    <el-input size="medium" v-model="prenatal.fhb" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Presentation" prop="presentation">
                                    <el-input size="medium" v-model="prenatal.presentation" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>