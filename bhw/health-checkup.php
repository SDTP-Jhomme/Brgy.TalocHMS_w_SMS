<div class="w-80 ">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Individual Treatment Form</h3>
            <el-main>
                <el-form :model="health" :rules="healthRules" ref="health">
                    <div class="underline-input top d-flex justify-content-end">
                        <div class="d-flex flex-wrap justify-content-between w-30">
                            <div class="w-45">
                                <el-form-item label="FSN" prop="fsn">
                                    <el-input size="medium" v-model="health.fsn" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45">
                                <el-form-item label="Clinisys FSN" prop="clinisysFSN">
                                    <el-input size="medium" v-model="health.clinisysFSN" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                    <div>
                        <el-divider></el-divider>
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
                        </div>
                    </div>
                    <!-- End -->

                    <div>
                        <el-divider></el-divider>
                    </div>
                    <div class="underline-input health">
                        <div class="mt-5 d-flex flex-wrap justify-content-around">
                            <div class="w-35 mb-4">
                                <el-form-item label="Civil Status" prop="civil">
                                    <el-select size="medium" v-model="health.civil" placeholder="Select" clearable>
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
                            <div class="w-35 mb-4">
                                <el-form-item label="Spouse" prop="spouse">
                                    <el-input size="medium" v-model="health.spouse" placeholder="If married" clearable :disabled="health.civil != 'Married'"></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-85 mb-4">
                                <el-form-item class="radio" label="Educational Attainment" prop="education">
                                    <el-radio-group v-model="health.education">
                                        <el-radio label="Elementary">Elementary</el-radio>
                                        <el-radio label="High School">High School</el-radio>
                                        <el-radio label="College">College</el-radio>
                                        <el-radio label="Post Grad">Post Grad</el-radio>
                                        <el-radio label="No Formal Educ.">No Formal Educ.</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-85 mb-4 d-flex">
                                <div class="w-50">
                                    <el-form-item label="Employment Status" prop="employment">
                                        <el-radio-group v-model="health.employment">
                                            <el-radio label="Student">Student</el-radio>
                                            <el-radio label="Unemployed">Unemployed</el-radio>
                                            <el-radio label="Employed">Employed</el-radio>
                                        </el-radio-group>
                                    </el-form-item>
                                </div>
                                <div class="w-50">
                                    <el-form-item label="Occupation" prop="occupation">
                                        <el-input size="medium" v-model="health.occupation" placeholder="If employed" :disabled="health.employment != 'Employed'" clearable></el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Religion" prop="religion">
                                    <el-input size="medium" v-model="health.religion" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item class="telephone" label="Telephone" prop="telephone">
                                    <el-input size="medium" v-model="health.telephone" placeholder="Mobile/Landline/Email" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Number/Street Name" prop="street">
                                    <el-input size="medium" v-model="health.street" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Purok" prop="purok">
                                    <el-input size="medium" v-model="health.purok" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Barangay" prop="barangay">
                                    <el-input size="medium" v-model="health.barangay" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="Blood Type" prop="blood">
                                    <el-input size="medium" v-model="health.blood" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-85 mb-4 d-flex">
                                <div class="w-60">
                                    <el-form-item label="Family Member" prop="member">
                                        <el-radio-group v-model="health.member">
                                            <el-radio label="Father">Father</el-radio>
                                            <el-radio label="Mother">Mother</el-radio>
                                            <el-radio label="Son">Son</el-radio>
                                            <el-radio label="Daughter">Daughter</el-radio>
                                            <el-radio label="Others">Others:</el-radio>
                                        </el-radio-group>
                                    </el-form-item>
                                </div>
                                <div class="w-40">
                                    <el-form-item label="Please specify" prop="otherMember">
                                        <el-input size="medium" v-model="health.otherMember" :disabled="health.member != 'Others'" clearable></el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item class="radio normal" label="PhilHealth Type" prop="phlType">
                                    <el-radio-group v-model="health.phlType">
                                        <el-radio label="Member">Member</el-radio>
                                        <el-radio label="Dependent">Dependent</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-35 mb-4">
                                <el-form-item label="PhilHealth Number" prop="philhealth">
                                    <el-input size="medium" v-model="health.philhealth" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-85 mb-4 d-flex justify-content-between">
                                <div class="w-33">
                                    <el-form-item label="Mother Last Name" prop="mLastName">
                                        <el-input size="medium" v-model="health.mLastName" clearable></el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-33">
                                    <el-form-item label="Mother First Name" prop="mFirstName">
                                        <el-input size="medium" v-model="health.mFirstName" clearable></el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-33">
                                    <el-form-item label="Mother Middle Name" prop="mMidName">
                                        <el-input size="medium" v-model="health.mMidName" clearable></el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="w-85 mb-4 d-flex justify-content-between">
                                <div class="w-33">
                                    <el-form-item label="NHTS Member" prop="nhts">
                                        <el-radio-group v-model="health.nhts">
                                            <el-radio label="Yes">Yes</el-radio>
                                            <el-radio label="No">No</el-radio>
                                        </el-radio-group>
                                    </el-form-item>
                                </div>
                                <div class="w-33">
                                    <el-form-item label="Pantawid Pamilya Member" prop="ppm">
                                        <el-radio-group v-model="health.ppm">
                                            <el-radio label="Yes">Yes</el-radio>
                                            <el-radio label="No">No</el-radio>
                                        </el-radio-group>
                                    </el-form-item>
                                </div>
                                <div class="w-33">
                                    <el-form-item label="If YES, HH No." prop="hhno">
                                        <el-input size="medium" v-model="health.hhno" clearable :disabled="health.ppm != 'Yes'"></el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="w-85 mb-4 d-flex justify-content-between flex-wrap">
                                <div class="w-100 alert-label">
                                    <label>Alert Type</label>
                                </div>
                                <div class="w-33">
                                    <el-form-item prop="allergy">
                                        <el-input size="medium" placeholder="Allergy" v-model="health.allergy" clearable></el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-33">
                                    <el-form-item prop="disability">
                                        <el-input size="medium" placeholder="Disability" v-model="health.disability" clearable></el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-33">
                                    <el-form-item prop="drug">
                                        <el-input size="medium" placeholder="Drug" v-model="health.drug" clearable></el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-33">
                                    <el-form-item prop="handicap">
                                        <el-input size="medium" placeholder="Handicap" v-model="health.handicap" clearable></el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-33">
                                    <el-form-item prop="impairment">
                                        <el-input size="medium" placeholder="Impairment" v-model="health.impairment" clearable></el-input>
                                    </el-form-item>
                                </div>
                                <div class="w-33">
                                    <el-form-item prop="otherAlert">
                                        <el-input size="medium" placeholder="Others" v-model="health.otherAlert" clearable></el-input>
                                    </el-form-item>
                                </div>
                            </div>
                            <div class="w-85 mb-4 d-flex justify-content-between flex-wrap">
                                <div class="w-50">
                                    <el-form-item label="Past Medical Family History" prop="history">
                                        <el-checkbox-group v-model="health.history">
                                            <el-checkbox label="HPN"></el-checkbox>
                                            <el-checkbox label="DM"></el-checkbox>
                                            <el-checkbox label="Asthma"></el-checkbox>
                                            <el-checkbox label="Smoker"></el-checkbox>
                                        </el-checkbox-group>
                                    </el-form-item>
                                </div>
                                <div class="w-50">
                                    <el-form-item label="Others" prop="history">
                                        <el-input size="medium" v-model="health.otherHistory" clearable></el-input>
                                    </el-form-item>
                                </div>
                            </div>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>