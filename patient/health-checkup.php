<div class="w-95 lg">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Individual Treatment Request Form</h3>
            <el-main>
                <el-form :model="health" :rules="healthRules" ref="health">
                    <div class="fs-6">
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Civil Status :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="civil">
                                    <el-select v-model="health.civil" placeholder="Select" clearable>
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
                                    <el-input v-model="health.spouse" clearable :disabled="health.civil != 'Married'"></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Educational Attainment :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="education">
                                    <el-radio-group v-model="health.education">
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
                                    <el-radio-group v-model="health.employment">
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
                                    <el-input v-model="health.occupation" :disabled="health.employment != 'Employed'" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Religion :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="religion">
                                    <el-input v-model="health.religion" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Number/Street Name :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="street">
                                    <el-input v-model="health.street" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Purok :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="purok">
                                    <el-input v-model="health.purok" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Barangay :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="barangay">
                                    <el-input v-model="health.barangay" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Blood Type :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="blood">
                                    <el-input v-model="health.blood" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Family Member :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio plus" prop="member">
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
                                    <el-input v-model="health.otherMember" :disabled="health.member != 'Others'" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>PhilHealth Type :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio normal" prop="phlType">
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
                                    <el-input v-model="health.philhealth" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-2">
                                <label for=""><span class="text-danger">*</span>Mother Last Name :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="mLastName">
                                    <el-input v-model="health.mLastName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-2">
                                <label for=""><span class="text-danger">*</span>Mother First Name :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="mLastName">
                                    <el-input v-model="health.mFirstName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-2">
                                <label for="">Mother Middle Name :</label>
                            </div>
                            <div class="col-2">
                                <el-form-item prop="mLastName">
                                    <el-input v-model="health.mMidName" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for="">NHTS Member :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio plus" prop="nhts">
                                    <el-radio-group v-model="health.nhts">
                                        <el-radio label="Yes">Yes</el-radio>
                                        <el-radio label="No">No</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="col-auto">
                                <label for="">Pantawid Pamilya Member :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio normal" prop="pantawid">
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
                                    <el-input v-model="health.hhNo" :disabled="health.pantawid != 'Yes'" id="hhno" OnInput="add_hyphen()" maxlength="14" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Alert Type :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item prop="alert">
                                    <el-select v-model="health.alert" placeholder="Select" clearable>
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
                                    <el-input v-model="health.otherAlert" clearable :disabled="health.alert != 'Others'"></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row g-3 mt-5">
                            <div class="col-auto">
                                <label for=""><span class="text-danger">*</span>Past medical family history :</label>
                            </div>
                            <div class="col-auto">
                                <el-form-item class="radio normal" prop="medicalHistory">
                                    <el-select v-model="health.medicalHistory" placeholder="Select" clearable>
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
                                    <el-input v-model="health.otherHistory" :disabled="health.medicalHistory != 'Others'" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>