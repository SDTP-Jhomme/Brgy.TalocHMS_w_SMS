<div class="w-90 lg">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Immunization Checkup Form</h3>
            <el-main>
                <!-- Patient Information -->
                <div class="label-format d-flex flex-wrap justify-content-evenly">
                    <div class="mb-4" :class="viewPatient.middleName && !viewPatient.suffix || !viewPatient.middleName && viewPatient.suffix ? 'w-30' : viewPatient.middleName && viewPatient.suffix ? 'w-20' : 'w-25'">
                        <label class="m-0">First Name</label>
                        <el-input value="<?php echo $db_firstname ?>" size="small" clearable disabled></el-input>
                    </div>
                    <div class="mb-4" :class="viewPatient.middleName && !viewPatient.suffix || !viewPatient.middleName && viewPatient.suffix ? 'w-30' : viewPatient.middleName && viewPatient.suffix ? 'w-20' : 'w-25'">
                        <label class="m-0">Last Name</label>
                        <el-input v-model="viewPatient.lastName" size="small" clearable disabled></el-input>
                    </div>
                    <div class="mb-4" :class="viewPatient.middleName && !viewPatient.suffix ? 'w-30' : viewPatient.middleName && viewPatient.suffix ? 'w-20' : 'w-25'" v-if="viewPatient.middleName">
                        <label class="m-0">Middle Name</label>
                        <el-input v-model="viewPatient.middleName" size="small" clearable disabled></el-input>
                    </div>
                    <div class="mb-4" :class="!viewPatient.middleName && viewPatient.suffix ? 'w-10' : viewPatient.middleName && viewPatient.suffix ? 'w-10' : 'w-25'" v-if="viewPatient.suffix">
                        <label class="m-0">Suffix</label>
                        <el-input v-model="viewPatient.suffix" size="small" clearable disabled></el-input>
                    </div>
                    <div class="d-flex flex-wrap" :class="viewPatient.middleName || viewPatient.suffix ? 'w-50 justify-content-evenly' : 'w-40 justify-content-between'">
                        <div class="mb-4 birth-width" :class="viewPatient.middleName && viewPatient.suffix || viewPatient.middleName || viewPatient.suffix ? 'w-50' : 'w-65'">
                            <label class="m-0">Birthdate</label>
                            <el-date-picker v-model="viewPatient.birthDate" type="date" size="small" placeholder="" disabled>
                            </el-date-picker>
                        </div>
                        <div class="mb-4" :class="!viewPatient.middleName && !viewPatient.suffix ? 'w-30' : 'w-20'">
                            <label class="m-0">Gender</label>
                            <el-input v-model="viewPatient.gender" size="small" clearable disabled></el-input>
                        </div>
                        <div class="mb-4" :class="!viewPatient.middleName && !viewPatient.suffix ? 'w-30' : 'w-40'">
                            <label class="m-0">Phone Number</label>
                            <el-input v-model="viewPatient.phoneNo" size="small" clearable disabled></el-input>
                        </div>
                    </div>
                </div>
                <!-- End -->
                <el-form :model="immunize" :rules="immunizationRules" ref="immunize">
                    <div class="underline-input top d-flex justify-content-end">
                        <div class="d-flex flex-wrap justify-content-between w-50">
                            <div class="w-40">
                                <el-form-item label="FSN :" prop="fsn">
                                    <el-input v-model="viewPatient.fsn" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-50">
                                <el-form-item label="Child's No. :" prop="childNo">
                                    <el-input v-model="immunize.childNo" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                    <div>
                        <el-divider></el-divider>
                    </div>
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

                    <el-divider></el-divider>

                    <div class="row g-3 align-items-center mt-5">
                        <div class="col-auto mb-4">
                            <label for="">Date :</label>
                        </div>
                        <div class="col-4 mb-4">
                            <el-form-item prop="appointment">
                                <el-input v-model="immunize.appointment" clearable disabled></el-input>
                            </el-form-item>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mt-5">
                        <div class="col-auto mb-4">
                            <label for="">Age :</label>
                        </div>
                        <div class="col-auto mb-4">
                            <el-form-item prop="age">
                                <el-input v-model="immunize.age" clearable disabled></el-input>
                            </el-form-item>
                        </div>
                        <div class="col-auto mb-4">
                            <label for="">Weight :</label>
                        </div>
                        <div class="col-auto mb-4">
                            <el-form-item prop="weight">
                                <el-input v-model="immunize.weight" clearable>
                                    <template slot="suffix">kg / lbs</template>
                                </el-input>
                            </el-form-item>
                        </div>
                        <div class="col-auto mb-4">
                            <label for="">Temp :</label>
                        </div>
                        <div class="col-auto mb-4">
                            <el-form-item prop="temp">
                                <el-input v-model="immunize.temp" clearable>
                                    <template slot="suffix">℃</template>
                                </el-input>
                            </el-form-item>
                        </div>
                    </div>

                    <div class="row g-3 align-items-center mt-5">
                        <div class="col-auto mb-4">
                            <label for="">Immunization Given :</label>
                        </div>
                        <div class="col-4 mb-4">
                            <el-form-item prop="immunizationGiven">
                                <el-input v-model="immunize.immunizationGiven" clearable></el-input>
                            </el-form-item>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>