<div class="w-75 lg">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Individual Treatment Form</h3>
            <el-main>
                <!-- Patient Information -->
                <div v-if="this.currentRow" class="label-format d-flex flex-wrap justify-content-evenly">
                    <div class="mb-4" :class="currentRow.middle_name && !currentRow.suffix || !currentRow.middle_name && currentRow.suffix ? 'w-30' : currentRow.middle_name && currentRow.suffix ? 'w-20' : 'w-25'">
                        <label class="m-0">First Name</label>
                        <el-input v-model="currentRow.first_name" size="small" clearable disabled></el-input>
                    </div>
                    <div class="mb-4" :class="currentRow.middle_name && !currentRow.suffix || !currentRow.middle_name && currentRow.suffix ? 'w-30' : currentRow.middle_name && currentRow.suffix ? 'w-20' : 'w-25'">
                        <label class="m-0">Last Name</label>
                        <el-input v-model="currentRow.last_name" size="small" clearable disabled></el-input>
                    </div>
                    <div v-if="currentRow.middle_name != 'undefined'" class="mb-4" :class="currentRow.middle_name && !currentRow.suffix ? 'w-30' : currentRow.middle_name && currentRow.suffix ? 'w-20' : 'w-25'">
                        <label class="m-0">Middle Name</label>
                        <el-input v-model="currentRow.middle_name" size="small" clearable disabled></el-input>
                    </div>
                    <div v-if="currentRow.suffix != 'undefined'" class="mb-4" :class="!currentRow.middle_name && currentRow.suffix ? 'w-10' : currentRow.middle_name && currentRow.suffix ? 'w-10' : 'w-25'">
                        <label class="m-0">Suffix</label>
                        <el-input v-model="currentRow.suffix" size="small" clearable disabled></el-input>
                    </div>
                    <div class="d-flex flex-wrap" :class="currentRow.middle_name || currentRow.suffix ? 'w-50 justify-content-evenly' : 'w-40 justify-content-between'">
                        <div class="mb-4 birth-width" :class="currentRow.middle_name && currentRow.suffix || currentRow.middle_name || currentRow.suffix ? 'w-50' : 'w-65'">
                            <label class="m-0">Birthdate</label>
                            <el-date-picker v-model="currentRow.birthdate" type="date" size="small" placeholder="" disabled>
                            </el-date-picker>
                        </div>
                        <div class="mb-4" :class="!currentRow.middle_name && !currentRow.suffix ? 'w-30' : 'w-20'">
                            <label class="m-0">Gender</label>
                            <el-input v-model="currentRow.gender" size="small" clearable disabled></el-input>
                        </div>
                        <div class="mb-4" :class="!addPatient.middleName && !addPatient.suffix ? 'w-30' : 'w-40'">
                            <label class="m-0">Phone Number</label>
                            <el-input v-model="currentRow.phone_number" size="small" clearable disabled></el-input>
                        </div>
                    </div>
                </div>
                <div v-else class="label-format d-flex flex-wrap justify-content-evenly">
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
                        <div class="mb-4" :class="!addPatient.middleName && !addPatient.suffix ? 'w-30' : 'w-40'">
                            <label class="m-0">Phone Number</label>
                            <el-input v-model="addPatient.phoneNo" size="small" clearable disabled></el-input>
                        </div>
                    </div>
                </div>
                <!-- End -->

                <div>
                    <el-divider></el-divider>
                </div>
                <el-form :model="health" :rules="healthRules" ref="health">
                    <div class="row g-3 mt-5">
                        <div class="col-auto">
                            <label for="">Fsn :</label>
                            <el-form-item prop="fsn">
                                <el-input v-model="health.fsn" size="small" clearable></el-input>
                            </el-form-item>
                        </div>
                        <div class="col-auto">
                            <label for="">Clinisys Fsn :</label>
                            <el-form-item prop="clinisys">
                                <el-input v-model="health.clinisys" size="small" clearable></el-input>
                            </el-form-item>
                        </div>
                    </div>
                    <div>
                        <el-divider></el-divider>
                    </div>
                    <div class="fs-6">
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Civil Status :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="civil">
                                    <el-select v-model="health.civil" placeholder="Select" size="small" clearable>
                                        <el-option label="Single" value="Single">
                                        </el-option>
                                        <el-option label="Married" value="Married">
                                        </el-option>
                                        <el-option label="Divorced" value="Divorced">
                                        </el-option>
                                        <el-option label="Separated" value="Separated">
                                        </el-option>
                                        <el-option label="Widowed" value="Widowed">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Spouse (If married) :</label>
                            </div>
                            <div class="col-auto mb-4">
                                <el-form-item prop="spouse">
                                    <el-input v-model="health.spouse" size="small" clearable :disabled="health.civil != 'Married'"></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Educational Attainment :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="education">
                                    <el-radio-group v-model="health.education" size="small">
                                        <el-radio label="Elementary">Elementary</el-radio>
                                        <el-radio label="High School">High School</el-radio>
                                        <el-radio label="College">College</el-radio>
                                        <el-radio label="Post Grad">Post Grad</el-radio>
                                        <el-radio label="No Formal Educ.">No Formal Educ.</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Employment Status :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="employment">
                                    <el-radio-group v-model="health.employment" size="small">
                                        <el-radio label="Student">Student</el-radio>
                                        <el-radio label="Unemployed">Unemployed</el-radio>
                                        <el-radio label="Employed">Employed</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="col-3">
                                <label for="">(Occupation if employed) :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="occupation">
                                    <el-input v-model="health.occupation" :disabled="health.employment != 'Employed'" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Religion :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="religion">
                                    <el-input v-model="health.religion" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Number/Street Name :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="purok">
                                    <el-input v-model="health.street" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Purok :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="purok">
                                    <el-input v-model="health.purok" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Barangay :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="barangay">
                                    <el-input v-model="health.barangay" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Blood Type :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="blood">
                                    <el-input v-model="health.blood" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Family Member :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio plus" prop="member" size="small">
                                    <el-radio-group v-model="health.member">
                                        <el-radio label="Father">Father</el-radio>
                                        <el-radio label="Mother">Mother</el-radio>
                                        <el-radio label="Son">Son</el-radio>
                                        <el-radio label="Daughter">Daughter</el-radio>
                                        <el-radio label="Others">Others:</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="col-2">
                                <label for="">Please specify :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="otherMember">
                                    <el-input v-model="health.otherMember" :disabled="health.member != 'Others'" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>PhilHealth Type :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio normal" prop="phlType" size="small">
                                    <el-radio-group v-model="health.phlType">
                                        <el-radio label="Member">Member</el-radio>
                                        <el-radio label="Dependent">Dependent</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>PhilHealth Number :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="philhealth">
                                    <el-input v-model="health.philhealth" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-2">
                                <label for=""><span class="text-danger">*</span>Mother Last Name :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="mLastName">
                                    <el-input v-model="health.mLastName" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-2">
                                <label for=""><span class="text-danger">*</span>Mother First Name :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="mLastName">
                                    <el-input v-model="health.mFirstName" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-2">
                                <label for="">Mother Middle Name :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="mLastName">
                                    <el-input v-model="health.mMidName" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for="">NHTS Member :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio plus" prop="nhts">
                                    <el-radio-group v-model="health.nhts" size="small">
                                        <el-radio label="Yes">Yes</el-radio>
                                        <el-radio label="No">No</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Pantawid Pamilya Member :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio normal" prop="pantawid" size="small">
                                    <el-radio-group v-model="health.pantawid">
                                        <el-radio label="Yes">Yes</el-radio>
                                        <el-radio label="No">No</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">If yes, HH no. :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="blank" prop="hhNo">
                                    <el-input v-model="health.hhNo" :disabled="health.pantawid != 'Yes'" id="hhno" onKeyup="addDashes(this)" maxlength="14" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Alert Type :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="alert">
                                    <el-select v-model="health.alert" placeholder="Select" size="small" clearable>
                                        <el-option label="Allergy" value="Allergy">
                                        </el-option>
                                        <el-option label="Disabilty" value="Disabilty">
                                        </el-option>
                                        <el-option label="Drug" value="Drug">
                                        </el-option>
                                        <el-option label="Handicap" value="Handicap">
                                        </el-option>
                                        <el-option label="Impairmaent" value="Impairmaent">
                                        </el-option>
                                        <el-option label="Others" value="Others">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Others :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="otherAlert">
                                    <el-input v-model="health.otherAlert" clearable :disabled="health.alert != 'Others'" size="small"></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Past medical family history :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio normal" prop="medicalHistory">
                                    <el-select v-model="health.medicalHistory" placeholder="Select" size="small" clearable>
                                        <el-option label="HPN" value="HPN">
                                        </el-option>
                                        <el-option label="DM" value="DM">
                                        </el-option>
                                        <el-option label="Asthma" value="Asthma">
                                        </el-option>
                                        <el-option label="Smoker" value="Smoker">
                                        </el-option>
                                        <el-option label="Others" value="Others">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Others :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="otherAlert">
                                    <el-input v-model="health.otherHistory" :disabled="health.medicalHistory != 'Others'" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Type of Encounter / (OPD) : (Pls. Check) :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio normal" prop="encounter">
                                    <el-radio-group v-model="health.encounter" size="small">
                                        <el-radio label="Consultation">Consultation</el-radio>
                                        <el-radio label="New Admission">New Admission</el-radio>
                                        <el-radio label="For follow-up">For follow-up</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Type of Consultation / Purpose of visit :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="consultationType">
                                    <el-select v-model="health.consultationType" placeholder="Select" size="small" clearable>
                                        <el-option label="General" value="General">General</el-option>
                                        <el-option label="Prental" value="Prental">Prenatal</el-option>
                                        <el-option label="Child Immunization" value="Child Immunization">Child Immunization</el-option>
                                        <el-option label="Others" value="Others">Others</el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Others :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="blank" prop="otherConsultation">
                                    <el-input v-model="health.otherConsultation" :disabled="health.consultationType != 'Others'" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for="">Consultation Date :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="appointment">
                                    <el-input v-model="health.appointment" size="small" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Age :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="age">
                                    <el-input v-model="health.age" size="small" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Mode of Transaction : (Pls. Check) :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio normal" prop="transaction">
                                    <el-radio-group v-model="health.transaction" size="small">
                                        <el-radio label="Walk-in">Walk-in</el-radio>
                                        <el-radio label="Visited">Visited</el-radio>
                                        <el-radio label="Referral">Referral</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for="">S :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="s">
                                    <el-input v-model="health.s" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for="">O :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="s">
                                    <el-input v-model="health.o" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="ps-5">
                            <div class="row g-3 mt-5">
                                <div class="col-auto">
                                    <label for="">PR / CR :</label>
                                </div>
                                <div class="col-auto">
                                    <el-form-item prop="pr">
                                        <el-input v-model="health.pr" clearable>
                                            <template slot="suffix">b / min</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="row g-3 mt-5">
                                <div class="col-auto">
                                    <label for="">RR :</label>
                                </div>
                                <div class="col-auto">
                                    <el-form-item prop="rr">
                                        <el-input v-model="health.rr" size="small" clearable>
                                            <template slot="suffix">c / min</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="row g-3 mt-5">
                                <div class="col-auto">
                                    <label for="">BP :</label>
                                </div>
                                <div class="col-auto">
                                    <el-form-item prop="bp">
                                        <el-input v-model="health.bp" size="small" clearable>
                                            <template slot="suffix">mmHg</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="row g-3 mt-5">
                                <div class="col-auto">
                                    <label for="">Weight :</label>
                                </div>
                                <div class="col-auto">
                                    <el-form-item prop="weight">
                                        <el-input v-model="health.weight" size="small" clearable>
                                            <template slot="suffix">kg . lbs</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="row g-3 mt-5">
                                <div class="col-auto">
                                    <label for="">Height :</label>
                                </div>
                                <div class="col-auto">
                                    <el-form-item prop="height">
                                        <el-input v-model="health.height" size="small" clearable>
                                            <template slot="suffix">cm / ft</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="row g-3 mt-5">
                                <div class="col-auto">
                                    <label for="">Temp :</label>
                                </div>
                                <div class="col-auto">
                                    <el-form-item prop="temp">
                                        <el-input v-model="health.temp" size="small" clearable>
                                            <template slot="suffix">℃</template>
                                        </el-input>
                                    </el-form-item>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for="">A :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="a">
                                    <el-input v-model="health.a" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for="">P :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="p">
                                    <el-input v-model="health.p" size="small" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>
<script>
    window.addDashes = function addDashes(f) {
        var r = /(\D+)/g,
            npa = '',
            nxx = '',
            last4 = '';
        f.value = f.value.replace(r, '');
        npa = f.value.substr(0, 3);
        nxx = f.value.substr(3, 3);
        last4 = f.value.substr(6, 4);
        f.value = npa + '-' + nxx + '-' + last4;
    }
</script>