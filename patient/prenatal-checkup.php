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
                            <div :class="addPatient.middleName ? 'w-30' : 'w-30'">
                                <label class="m-0">Gender</label>
                                <el-input v-model="addPatient.gender" size="small" clearable disabled></el-input>
                            </div>
                            <div class="mb-4" :class="!addPatient.middleName && !addPatient.suffix ? 'w-40' : 'w-35'">
                                <label class="m-0">Phone Number</label>
                                <el-input v-model="addPatient.phoneNo" size="small" clearable disabled></el-input>
                            </div>
                            <div class="mb-4" :class="!addPatient.middleName && !addPatient.suffix ? 'w-30' : 'w-20'">
                                <label class="m-0">FSN</label>
                                <el-input v-model="addPatient.fsn" size="small" clearable disabled></el-input>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
                    <div class="underline-input">
                        <div class="mt-5 d-flex flex-wrap justify-content-between">
                        </div>
                    </div>
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
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for="" class="fw-bold">PRE-NATAL :</label>
                            </div>
                            <div class="col-auto">
                                <label for="">GP :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="gp">
                                    <el-input size="medium" v-model="prenatal.gp" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">LMP :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="lmp">
                                    <el-input size="medium" v-model="prenatal.lmp" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for="">EDC :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="edc">
                                    <el-date-picker size="medium" v-model="prenatal.edc" type="date" placeholder="Select Date">
                                    </el-date-picker>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">T.T. Status :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="ttStatus">
                                    <el-input size="medium" v-model="prenatal.ttStatus" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>

                        <el-divider></el-divider>

                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Appointment :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="appointment">
                                    <el-date-picker size="medium" v-model="prenatal.appointment" type="date" placeholder="Select Date" disabled>
                                    </el-date-picker>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Date of Prenatal Visit :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="appointment">
                                    <el-date-picker size="medium" v-model="prenatal.appointment" type="date" placeholder="Select Date">
                                    </el-date-picker>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for="">Weight :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="weight">
                                    <el-input size="medium" v-model="prenatal.weight" clearable>
                                        <template slot="suffix">kg / lbs</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">BP :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="bp">
                                    <el-input size="medium" v-model="prenatal.bp" clearable>
                                        <template slot="suffix">mmHg</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for="">CR :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="cr">
                                    <el-input size="medium" v-model="prenatal.cr" clearable>
                                        <template slot="suffix">b / min</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">RR :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="rr">
                                    <el-input size="medium" v-model="prenatal.rr" clearable>
                                        <template slot="suffix">c / min</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                            <div class="col-1">
                                <label for="">Temp :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="temp">
                                    <el-input size="medium" v-model="prenatal.temp" clearable>
                                        <template slot="suffix">℃</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for="">AOG :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="aog">
                                    <el-input size="medium" v-model="prenatal.aog" clearable>
                                        <template slot="suffix">weeks</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for="">Fundic Height :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="height">
                                    <el-input size="medium" v-model="prenatal.height" clearable>
                                        <template slot="suffix">cm / inch</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for="">FHB :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="fhb">
                                    <el-input size="medium" v-model="prenatal.fhb" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-5">
                            <div class="col-auto">
                                <label for="">Presentation :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="presentation">
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