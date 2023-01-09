<div class="w-70 lg">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Family Planning Form</h3>
            <el-main>
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
                            <el-input v-model="prenatal.fsn" size="small" clearable></el-input>
                        </div>
                    </div>
                </div>

                <el-form :model="family" :rules="familyRules" ref="family">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for=""><span class="text-danger">*</span>Address : Purok</label>
                        </div>
                        <div class="col-auto">
                            <el-form-item prop="purok">
                                <el-select v-model="family.purok" placeholder="Select Purok" clearable>
                                    <el-option label="Dangal" value="Dangal">
                                    </el-option>
                                    <el-option label="Baybay 13" value="Baybay 13">
                                    </el-option>
                                    <el-option label="Fatima" value="Fatima">
                                    </el-option>
                                    <el-option label="Hilado" value="Hilado">
                                    </el-option>
                                    <el-option label="13" value="13">
                                    </el-option>
                                    <el-option label="Paghidaet" value="Paghidaet">
                                    </el-option>
                                    <el-option label="Trese y Medya" value="Trese y Medya">
                                    </el-option>
                                    <el-option label="Marietta Village" value="Marietta Village">
                                    </el-option>
                                    <el-option label="Cubay" value="Cubay">
                                    </el-option>
                                    <el-option label="Langka" value="Langka">
                                    </el-option>
                                    <el-option label="Paho North" value="Paho North">
                                    </el-option>
                                    <el-option label="Paho South" value="Paho South">
                                    </el-option>
                                    <el-option label="Kawayanan" value="Kawayanan">
                                    </el-option>
                                    <el-option label="Ramos" value="Ramos">
                                    </el-option>
                                    <el-option label="Para Uno" value="Para Uno">
                                    </el-option>
                                    <el-option label="Para Dos" value="Para Dos">
                                    </el-option>
                                    <el-option label="Camingawan" value="Camingawan">
                                    </el-option>
                                    <el-option label="Newton" value="Newton">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-auto">
                            <label for=""><span class="text-danger">*</span>Barangay :</label>
                        </div>
                        <div class="col-auto">
                            <el-form-item prop="barangay">
                                <el-input size="medium" v-model="family.barangay" disabled></el-input>
                            </el-form-item>
                        </div>
                    </div>
                    <!-- End -->
                    <div>
                        <el-divider></el-divider>
                    </div>
                    <div class="">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Appointment :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="appointment">
                                    <el-date-picker size="medium" v-model="family.appointment" type="date" placeholder="Select Date" disabled>
                                    </el-date-picker>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="fs-4">Demographic and Other Information</label>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="">Spouse First Name :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="spouseFname">
                                    <el-input size="medium" v-model="family.spouseFname" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Spouse Last Name :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="spouseLname">
                                    <el-input size="medium" v-model="family.spouseLname" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Spouse Address : Purok</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="purok">
                                    <el-input size="medium" v-model="family.spousePurok" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Spouse Barangay :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="barangay">
                                    <el-input size="medium" v-model="family.spouseBarangay" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div>
                            <el-divider></el-divider>
                        </div>
                        <div class="row">
                            <label for="" class="fs-4">MEDICAL HISTORY :</label>
                        </div>
                        <div class="row">
                            <label for="" class="fs-6">HEENT :</label>
                        </div>
                        <div class="row g-3 align-items-center my-5">
                            <div class="col-12">
                                <el-form-item prop="heent">
                                    <el-checkbox v-model="family.heent" label="Epilepsy/Convulsion/Seizure"></el-checkbox>
                                    <el-checkbox v-model="family.heent" label="Severe headache/dizziness"></el-checkbox>
                                    <el-checkbox v-model="family.heent" label="Visual Disturbance"></el-checkbox>
                                    <el-checkbox v-model="family.heent" label="Yellowish Conjunctiva"></el-checkbox>
                                    <el-checkbox v-model="family.heent" label="Enlarged thyroid"></el-checkbox>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="fs-4">PHYSICAL EXAMINATION :</label>
                        </div>
                        <div class="row">
                            <label for="" class="fs-6">VITAL SIGNS :</label>
                        </div>
                        <div class="row g-3 align-items-center mb-5">
                            <div class="col-auto">
                                <label for="">BP :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="bp">
                                    <el-input size="medium" v-model="family.bp" type="number" clearable>
                                        <template slot="suffix">mmHg</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Weight :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="weight">
                                    <el-input size="medium" v-model="family.weight" type="number" clearable>
                                        <template slot="suffix">kg / lbs</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Pulse Rate :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="pr">
                                    <el-input size="medium" v-model="family.pr" type="number" clearable>
                                        <template slot="suffix">/mm</template>
                                    </el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="fs-6">CHEST/HEART AND LUNGS/BREAST :</label>
                        </div>
                        <div class="row g-3 align-items-center mb-5">
                            <div class="col-auto">
                                <el-form-item prop="chLB">
                                    <el-checkbox v-model="family.chLB" label="Severe chest pain"></el-checkbox>
                                    <el-checkbox v-model="family.chLB" label="Shortness of breath"></el-checkbox>
                                    <el-checkbox v-model="family.chLB" label="Breast / Axillary masses"></el-checkbox>
                                    <el-checkbox v-model="family.chLB" label="Nipple discharges(if blood or pus)"></el-checkbox>
                                    <el-checkbox v-model="family.chLB" label="BP Systolic of 140mm Hg & above"></el-checkbox>
                                    <el-checkbox v-model="family.chLB" label="BP Diastolic above 90mm Hg"></el-checkbox>
                                    <el-checkbox v-model="family.chLB" label="Family history of CVA (strokes), heart attack, heart disease"></el-checkbox>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="fs-6">HEAD AND NECK :</label>
                        </div>
                        <div class="row">
                            <label for="">Conjunctive :</label>
                        </div>
                        <div class="row g-3 align-items-center mb-5">
                            <div class="col-auto">
                                <el-form-item prop="conjunctive">
                                    <el-checkbox v-model="family.conjunctive" label="Pale"></el-checkbox>
                                    <el-checkbox v-model="family.conjunctive" label="Reddish"></el-checkbox>
                                    <el-checkbox v-model="family.conjunctive" label="Yellowish"></el-checkbox>
                                    <el-checkbox v-model="family.conjunctive" label="Discharge"></el-checkbox>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row">
                            <label for="">Neck :</label>
                        </div>
                        <div class="row g-3 align-items-center mb-5">
                            <div class="col-auto">
                                <el-form-item prop="neck">
                                    <el-checkbox v-model="family.neck" label="Enlarged thyroid"></el-checkbox>
                                    <el-checkbox v-model="family.neck" label="Enlarged lymph nodes"></el-checkbox>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="fs-6">ABDOMEN :</label>
                        </div>
                        <div class="row g-3 align-items-center mb-5">
                            <div class="col-auto">
                                <el-form-item prop="abdomen">
                                    <el-checkbox v-model="family.abdomen" label="Mass in the Abdomen"></el-checkbox>
                                    <el-checkbox v-model="family.abdomen" label="History of gallbladder disease"></el-checkbox>
                                    <el-checkbox v-model="family.abdomen" label="History of liver disease"></el-checkbox>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="fs-6">THORAX :</label>
                        </div>
                        <div class="row g-3 align-items-center mb-5">
                            <div class="col-auto">
                                <el-form-item prop="thorax">
                                    <el-checkbox v-model="family.thorax" label="Abnormal heart sounds/cardiac rate"></el-checkbox>
                                    <el-checkbox v-model="family.thorax" label="Abnormal breath sounds/respiratory rate"></el-checkbox>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="fs-6">GENITAL :</label>
                        </div>
                        <div class="row g-3 align-items-center mb-5">
                            <div class="col-auto">
                                <label for="">FEMALE :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="femGenital">
                                    <el-checkbox v-model="family.femGenital" label="Mass in the Uterus"></el-checkbox>
                                    <el-checkbox v-model="family.femGenital" label="Vaginal discharge"></el-checkbox>
                                    <el-checkbox v-model="family.femGenital" label="Dyspareunia"></el-checkbox>
                                    <el-checkbox v-model="family.femGenital" label="Unusual vaginal bleeding"></el-checkbox>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-5">
                            <div class="col-auto">
                                <label for="">MALE :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="maleGenital">
                                    <el-checkbox v-model="family.maleGenital" label="Hernia"></el-checkbox>
                                    <el-checkbox v-model="family.maleGenital" label="Varicocele"></el-checkbox>
                                    <el-checkbox v-model="family.maleGenital" label="Hydrocele"></el-checkbox>
                                    <el-checkbox v-model="family.maleGenital" label="Urethral discharge"></el-checkbox>
                                    <el-checkbox v-model="family.maleGenital" label="Prostate enlargement"></el-checkbox>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>