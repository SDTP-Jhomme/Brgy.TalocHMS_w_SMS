<div class="w-90">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Immunization Checkup Form</h3>
            <el-main>
                <el-form :model="immunize" :rules="immunizationRules" ref="immunize">
                    <div class="underline-input top d-flex justify-content-end">
                        <div class="d-flex flex-wrap justify-content-between w-50">
                            <div class="w-40">
                                <el-form-item label="FSN :" prop="fsn">
                                    <el-input v-model="addPatient.fsn" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-50">
                                <el-form-item label="Child's No. :" prop="childNo">
                                    <el-input v-model="immunize.childNo" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                    <!-- Patient Information -->
                    <div class="label-format d-flex flex-wrap justify-content-evenly">
                        <div class="mb-4" :class="addPatient.middleName && !addPatient.suffix || !addPatient.middleName && addPatient.suffix ? 'w-30' : addPatient.middleName && addPatient.suffix ? 'w-20' : 'w-25'">
                            <label class="m-0">First Name</label>
                            <el-input v-model="addPatient.firstName" size="small" clearable disabled></el-input>
                        </div>
                        <div class="mb-4" :class="addPatient.middleName && !addPatient.suffix || !addPatient.middleName && addPatient.suffix ? 'w-30' : addPatient.middleName && addPatient.suffix ? 'w-20' : 'w-25'">
                            <label class="m-0">Last Name</label>
                            <el-input v-model="addPatient.lastName" size="small" clearable disabled></el-input>
                        </div>
                        <div class="mb-4" :class="addPatient.middleName && !addPatient.suffix ? 'w-30' : addPatient.middleName && addPatient.suffix ? 'w-20' : 'w-25'" v-if="addPatient.middleName">
                            <label class="m-0">Middle Name</label>
                            <el-input v-model="addPatient.middleName" size="small" clearable disabled></el-input>
                        </div>
                        <div class="mb-4" :class="!addPatient.middleName && addPatient.suffix ? 'w-10' : addPatient.middleName && addPatient.suffix ? 'w-10' : 'w-25'" v-if="addPatient.suffix">
                            <label class="m-0">Suffix</label>
                            <el-input v-model="addPatient.suffix" size="small" clearable disabled></el-input>
                        </div>
                        <div class="d-flex flex-wrap" :class="addPatient.middleName || addPatient.suffix ? 'w-50 justify-content-evenly' : 'w-40 justify-content-between'">
                            <div class="mb-4 birth-width" :class="addPatient.middleName && addPatient.suffix || addPatient.middleName || addPatient.suffix ? 'w-50' : 'w-65'">
                                <label class="m-0">Birthdate</label>
                                <el-date-picker v-model="addPatient.birthDate" type="date" size="small" placeholder="" disabled>
                                </el-date-picker>
                            </div>
                            <div class="mb-4" :class="!addPatient.middleName && !addPatient.suffix ? 'w-30' : 'w-20'">
                                <label class="m-0">Gender</label>
                                <el-input v-model="addPatient.gender" size="small" clearable disabled></el-input>
                            </div>
                            <div class="mb-4" :class="!addPatient.middleName && !addPatient.suffix ? 'w-30' : 'w-20'">
                                <label class="m-0">Phone Number</label>
                                <el-input v-model="addPatient.phoneNo" size="small" clearable disabled></el-input>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
                    <div>
                        <el-divider></el-divider>
                    </div>
                    <div class="underline-input">
                        <div class="mt-5 d-flex flex-wrap justify-content-between">
                            <div class="w-33 mb-4">
                                <el-form-item label="Mother Last Name :" prop="mLastName">
                                    <el-input v-model="immunize.mLastName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item label="Mother First Name :" prop="mFirstName">
                                    <el-input v-model="immunize.mFirstName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item class="column" label="Mother Middle Name :" prop="mMidName">
                                    <el-input v-model="immunize.mMidName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item label="Father Last Name :" prop="fLastName">
                                    <el-input v-model="immunize.fLastName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item label="Father First Name :" prop="fFirstName">
                                    <el-input v-model="immunize.fFirstName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item class="column" label="Father Middle Name :" prop="fMidName">
                                    <el-input v-model="immunize.fMidName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Purok :" prop="purok">
                                    <el-input v-model="immunize.purok" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Barangay :" prop="barangay">
                                    <el-input v-model="immunize.barangay" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Date :" prop="appointment">
                                    <el-input v-model="immunize.appointment" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-20 mb-4">
                                <el-form-item label="Age :" prop="age">
                                    <el-input v-model="immunize.age" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-20 mb-4">
                                <el-form-item label="Temp :" prop="temp">
                                    <el-input v-model="immunize.temp" clearable></el-input>
                                    <template slot="suffix">℃</template>
                                </el-form-item>
                            </div>
                            <div class="w-70 mb-4">
                                <el-form-item label="Immunization Given :" prop="immunizationGiven">
                                    <el-input v-model="immunize.immunizationGiven" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>