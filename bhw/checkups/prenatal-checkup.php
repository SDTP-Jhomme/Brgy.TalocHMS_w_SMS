<div class="w-70 lg">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Prenatal Checkup Form</h3>
            <el-main>
                <el-form :model="prenatal" ref="prenatal">
                    <div class="underline-input top d-flex justify-content-end">
                        <div class="d-flex flex-wrap justify-content-end w-30">
                            <div class="w-75">
                                <el-form-item label="FSN" prop="fsn" class="mr-2">
                                    <el-input size="medium" v-model="addPatient.fsn" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                    <div>
                        <el-divider></el-divider>
                    </div>

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
                            <div class="w-50 mb-4">
                                <el-form-item label="Name of Spouse" prop="spouse">
                                    <el-input size="medium" v-model="prenatal.spouse" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-20 mb-4">
                                <el-form-item label="Phone Number" prop="phone">
                                    <el-input size="medium" v-model="addPatient.phone" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-85 mb-4 d-flex justify-content-between flex-wrap">
                                <div class="w-100 alert-label">
                                    <label>Address</label>
                                </div>
                                <div class="w-40">
                                    <el-form-item prop="purok">
                                        <el-input size="medium" placeholder="Purok" v-model="prenatal.allergy" clearable>
                                        </el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-50">
                                    <el-form-item prop="brgy">
                                        <el-input size="medium" placeholder="Barangay" v-model="prenatal.brgy" clearable>
                                        </el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="w-85 mb-4 d-flex justify-content-between flex-wrap">
                                <div class="w-100 alert-label">
                                    <label>PRE-NATAL</label>
                                </div>
                                <div class="w-20">
                                    <el-form-item prop="g">
                                        <el-input size="medium" v-model="prenatal.g" clearable>
                                            <template slot="prepend">G</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-30">
                                    <el-form-item prop="p">
                                        <el-input size="medium" v-model="prenatal.p" clearable>
                                            <template slot="prepend">P</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-40">
                                    <el-form-item prop="lmp">
                                        <el-input size="medium" v-model="prenatal.lmp" clearable>
                                            <template slot="prepend">LMP</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-45">
                                    <el-form-item prop="edc">
                                        <el-input size="medium" v-model="prenatal.edc" clearable>
                                            <template slot="prepend">EDC</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-45">
                                    <el-form-item prop="status">
                                        <el-input size="medium" v-model="prenatal.status" clearable>
                                            <template slot="prepend">T.T. Status</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
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
                            <div class="w-35 mb-4">
                                <el-form-item label="Appointment Date" prop="appointment">
                                    <el-input size="medium" v-model="date" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>