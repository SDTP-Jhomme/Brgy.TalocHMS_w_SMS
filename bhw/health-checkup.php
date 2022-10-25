<div class="w-90">
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center mb-4">Individual Treatment Form</h3>
            <el-main>
                <el-form :model="health" :rules="healthRules" ref="health">
                    <div class="underline-input top d-flex justify-content-end">
                        <div class="d-flex flex-wrap justify-content-between w-50">
                            <div class="w-40">
                                <el-form-item label="FSN :" prop="fsn">
                                    <el-input v-model="addPatient.fsn" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-50">
                                <el-form-item label="Clinisys FSN :" prop="clinisysFSN">
                                    <el-input v-model="health.clinisysFSN" clearable></el-input>
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
                        <div class="mt-5 d-flex flex-wrap justify-content-between">
                            <div class="w-45 mb-4">
                                <el-form-item label="Civil Status :" prop="civil">
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
                            <div class="w-45 mb-4">
                                <el-form-item label="Spouse (If married) :" prop="spouse">
                                    <el-input v-model="health.spouse" clearable :disabled="health.civil != 'Married'"></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-100 mb-4">
                                <el-form-item class="radio" label="Educational Attainment :" prop="education">
                                    <el-radio-group v-model="health.education">
                                        <el-radio label="Elementary">Elementary</el-radio>
                                        <el-radio label="High School">High School</el-radio>
                                        <el-radio label="College">College</el-radio>
                                        <el-radio label="Post Grad">Post Grad</el-radio>
                                        <el-radio label="No Formal Educ.">No Formal Educ.</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-60 mb-4">
                                <el-form-item class="radio plus" label="Employment Status :" prop="employment">
                                    <el-radio-group v-model="health.employment">
                                        <el-radio label="Student">Student</el-radio>
                                        <el-radio label="Unemployed">Unemployed</el-radio>
                                        <el-radio label="Employed">Employed</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-40 mb-4">
                                <el-form-item class="blank" label="Occupation (If employed) :" prop="occupation">
                                    <el-input v-model="health.occupation" :disabled="health.employment != 'Employed'" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Religion :" prop="religion">
                                    <el-input v-model="health.religion" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item class="telephone" label="Telephone (Mobile/Landline/Email) :" prop="phoneNo">
                                    <el-input v-model="addPatient.phoneNo" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Number/Street Name :" prop="street">
                                    <el-input v-model="health.street" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Purok :" prop="purok">
                                    <el-input v-model="health.purok" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Barangay :" prop="barangay">
                                    <el-input v-model="health.barangay" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Blood Type :" prop="blood">
                                    <el-input v-model="health.blood" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-70 mb-4">
                                <el-form-item class="radio plus" label="Family Member :" prop="member">
                                    <el-radio-group v-model="health.member">
                                        <el-radio label="Father">Father</el-radio>
                                        <el-radio label="Mother">Mother</el-radio>
                                        <el-radio label="Son">Son</el-radio>
                                        <el-radio label="Daughter">Daughter</el-radio>
                                        <el-radio label="Others">Others:</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-30 mb-4">
                                <el-form-item class="blank" label="Please specify :" prop="otherMember">
                                    <el-input v-model="health.otherMember" :disabled="health.member != 'Others'" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item class="radio normal" label="PhilHealth Type :" prop="phlType">
                                    <el-radio-group v-model="health.phlType">
                                        <el-radio label="Member">Member</el-radio>
                                        <el-radio label="Dependent">Dependent</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="PhilHealth Number :" prop="philhealth">
                                    <el-input v-model="health.philhealth" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item label="Mother Last Name :" prop="mLastName">
                                    <el-input v-model="health.mLastName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item label="Mother First Name :" prop="mFirstName">
                                    <el-input v-model="health.mFirstName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item class="column" label="Mother Middle Name :" prop="mMidName">
                                    <el-input v-model="health.mMidName" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item class="radio plus" label="NHTS Member :" prop="nhts">
                                    <el-radio-group v-model="health.nhts">
                                        <el-radio label="Yes">Yes</el-radio>
                                        <el-radio label="No">No</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item class="radio normal" label="Pantawid Pamilya Member :" prop="pantawid">
                                    <el-radio-group v-model="health.pantawid">
                                        <el-radio label="Yes">Yes</el-radio>
                                        <el-radio label="No">No</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-33 mb-4">
                                <el-form-item class="blank" label="If yes, HH no. :" prop="hhNo">
                                    <el-input v-model="health.hhNo" :disabled="health.pantawid != 'Yes'" id="hhno" OnInput="add_hyphen()" maxlength="14" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Alert Type :" prop="alert">
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
                            <div class="w-45 mb-4">
                                <el-form-item label="Others :" prop="otherAlert">
                                    <el-input v-model="health.otherAlert" clearable :disabled="health.alert != 'Others'"></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item class="radio normal" label="Past medical family history :" prop="medicalHistory">
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
                            <div class="w-45 mb-4">
                                <el-form-item class="blank" label="Others :" prop="otherHistory">
                                    <el-input v-model="health.otherHistory" :disabled="health.medicalHistory != 'Others'" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-70 mb-4">
                                <el-form-item class="radio normal" label=" Type of Encounter / (OPD) : (Pls. Check) " prop="encounter">
                                    <el-radio-group v-model="health.encounter">
                                        <el-radio label="Consultation">Consultation</el-radio>
                                        <el-radio label="New Admission">New Admission</el-radio>
                                        <el-radio label="For follow-up">For follow-up</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-50 mb-4">
                                <el-form-item label=" Type of Consultation / Purpose of visit : " prop="consultationType">
                                    <el-select v-model="health.consultationType" placeholder="Select" clearable>
                                        <el-option label="General" value="General">General</el-option>
                                        <el-option label="Prental" value="Prental">Prental</el-option>
                                        <el-option label="Child Immunization" value="Child Immunization">Child Immunization</el-option>
                                        <el-option label="Others" value="Others">Others</el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item class="blank" label="Others :" prop="otherConsultation">
                                    <el-input v-model="health.otherConsultation" :disabled="health.consultationType != 'Others'" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item label="Consultaion Date :" prop="appointment">
                                    <el-input v-model="health.appointment" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-20 mb-4">
                                <el-form-item label="Age :" prop="age">
                                    <el-input v-model="health.age" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 mb-4">
                                <el-form-item class="radio normal" label=" Mode of Transaction : (Pls. Check)" prop="transaction">
                                    <el-radio-group v-model="health.transaction">
                                        <el-radio label="Walk-in">Walk-in</el-radio>
                                        <el-radio label="Visited">Visited</el-radio>
                                        <el-radio label="Referral">Referral</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                            <div class="w-60 mb-4">
                                <el-form-item label="S :" prop="s">
                                    <el-input v-model="health.s" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-60 mb-4">
                                <el-form-item label="O :" prop="o">
                                    <el-input v-model="health.o" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-45 d-flex justify-content-center mb-4">
                                <el-form-item class="measurement" label="PR / CR :" prop="pr">
                                    <el-input v-model="health.pr" clearable></el-input>
                                    <p>b/min</p>
                                </el-form-item>
                            </div>
                            <div class="w-45 d-flex justify-content-center mb-4">
                                <el-form-item class="measurement" label="RR :" prop="rr">
                                    <el-input v-model="health.rr" clearable></el-input>
                                    <p>c/min</p>
                                </el-form-item>
                            </div>
                            <div class="w-45 d-flex justify-content-center mb-4">
                                <el-form-item class="measurement" label="BP :" prop="bp">
                                    <el-input v-model="health.bp" clearable></el-input>
                                    <p>mmHg</p>
                                </el-form-item>
                            </div>
                            <div class="w-45 d-flex justify-content-center mb-4">
                                <el-form-item class="measurement" label="Weight :" prop="weight">
                                    <el-input v-model="health.weight" clearable></el-input>
                                    <p>kgs/lbs</p>
                                </el-form-item>
                            </div>
                            <div class="w-45 d-flex justify-content-center mb-4">
                                <el-form-item class="measurement" label="Height :" prop="height">
                                    <el-input v-model="health.height" clearable></el-input>
                                    <p>cm/ft</p>
                                </el-form-item>
                            </div>
                            <div class="w-45 d-flex justify-content-center mb-4">
                                <el-form-item class="measurement" label="Temp :" prop="temp">
                                    <el-input v-model="health.temp" clearable></el-input>
                                    <p>℃</p>
                                </el-form-item>
                            </div>
                            <div class="w-60 mb-4">
                                <el-form-item label="A :" prop="a">
                                    <el-input v-model="health.a" clearable></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-60 mb-4">
                                <el-form-item label="P :" prop="p">
                                    <el-input v-model="health.p" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>