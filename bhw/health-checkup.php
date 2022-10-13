<div class="card">
    <el-container>
        <el-header height="0px"></el-header>
        <el-row class="mb-3">
            <el-col class="text-center">
                CITY HEALTH OFFICE
            </el-col>
            <el-col class="text-center">
                Bago City
            </el-col>
            <el-col class="text-center">
                INDIVIDUAL TREATMENT RECORD
            </el-col>
        </el-row>
        <el-form :model="addPatient" :rules="addRules" ref="addPatient" class="mx-5 underline-input">
            <el-row :gutter="20" class="mx-3">
                <el-col :span="7">
                    <el-form-item prop="lastName">
                        <label class="m-0"><span class="text-danger">*</span> Last Name</label>
                        <el-input v-model="addPatient.lastName" disabled></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="7">
                    <el-form-item prop="firstName">
                        <label class="m-0"><span class="text-danger">*</span> First Name</label>
                        <el-input v-model="addPatient.firstName" disabled></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="6">
                    <el-form-item prop="middleName">
                        <label class="m-0">Middle Name</label>
                        <el-input v-model="addPatient.middleName" clearable></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="2">
                    <el-form-item prop="suffix">
                        <label class="m-0">Suffix</label>
                        <el-input v-model="addPatient.suffix" clearable></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="7">
                    <el-form-item prop="birthDate">
                        <label class="m-0 d-block"><span class="text-danger">*</span> Birthdate</label>
                        <el-date-picker v-model="addPatient.birthDate" type="date" placeholder="" disabled>
                        </el-date-picker>
                    </el-form-item>
                </el-col>
                <el-col :span="7">
                    <el-form-item prop="gender">
                        <label class="m-0"><span class="text-danger">*</span> Gender</label>
                        <div>
                            <el-radio v-model="addPatient.gender" label="Male" disabled>Male</el-radio>
                            <el-radio v-model="addPatient.gender" label="Female" disabled>Female</el-radio>
                        </div>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item prop="civil">
                        <label class="m-0"><span class="text-danger">*</span> Civil Status</label>
                        <el-select v-model="addPatient.civil" clearable>
                            <el-option value="Single" label="Single"></el-option>
                            <el-option value="Married" label="Married"></el-option>
                            <el-option value="Divorced" label="Divorced"></el-option>
                            <el-option value="Widowed" label="Widowed"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item prop="spouse">
                        <label class="m-0">Spouse(if married)</label>
                        <el-input v-if="addPatient.civil=='Married'" v-model="addPatient.spouse" clearable></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="50">
                    <el-form-item prop="educAttainment">
                        <label class="m-0"><span class="text-danger">*</span> Educational Attainment (Pls. Check)</label>
                        <el-radio-group v-model="addPatient.educAttainment" size="medium">
                            <el-radio-button label="Elementary">Elementary</el-radio-button>
                            <el-radio-button label="High School">High School</el-radio-button>
                            <el-radio-button label="College">College</el-radio-button>
                            <el-radio-button label="Post Grad">Post Grad</el-radio-button>
                            <el-radio-button label="No Formal Educ">No Formal Educ</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="10">
                    <el-form-item prop="emloymentStatus">
                        <label class="m-0"><span class="text-danger">*</span> Employment Status (Pls. Check)</label>
                        <el-radio-group v-model="addPatient.emloymentStatus" size="medium">
                            <el-radio-button label="Student">Student</el-radio-button>
                            <el-radio-button label="Unemployed">Unemployed</el-radio-button>
                            <el-radio-button label="Employed">Employed</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item prop="occupation">
                        <label class="m-0">(Occupation if employed)</label>
                        <el-input v-if="addPatient.emloymentStatus=='Employed'" v-model="addPatient.occupation"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="7">
                    <el-form-item prop="religion">
                        <label class="m-0"><span class="text-danger">*</span>Religion</label>
                        <el-input v-model="addPatient.religion"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="15">
                    <el-form-item prop="telephone">
                        <label class="m-0"><span class="text-danger">*</span>Telephone</label>
                        <el-input v-model="addPatient.telephone"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="11">
                    <el-form-item prop="street">
                        <label class="m-0"><span class="text-danger">*</span>Number/Street Name</label>
                        <el-input v-model="addPatient.street"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="11">
                    <el-form-item prop="purok">
                        <label class="m-0"><span class="text-danger">*</span>Purok</label>
                        <el-input v-model="addPatient.purok"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="11">
                    <el-form-item prop="barangay">
                        <label class="m-0"><span class="text-danger">*</span>Barangay</label>
                        <el-input v-model="addPatient.barangay"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="6">
                    <el-form-item prop="bloodType">
                        <label class="m-0"><span class="text-danger">*</span>Blood Type</label>
                        <el-select v-model="addPatient.bloodType">
                            <el-option value="A" label="Type A"></el-option>
                            <el-option value="B" label="Type B"></el-option>
                            <el-option value="AB" label="Type AB"></el-option>
                            <el-option value="O" label="Type O"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="10">
                    <el-form-item prop="familyMember">
                        <label class="m-0"><span class="text-danger">*</span> Family Member (Pls. Check)</label>
                        <el-radio-group v-model="addPatient.familyMember" size="medium">
                            <el-radio-button label="Father">Father</el-radio-button>
                            <el-radio-button label="Mother">Mother</el-radio-button>
                            <el-radio-button label="Son">Son</el-radio-button>
                            <el-radio-button label="Daughter">Daughter</el-radio-button>
                            <el-radio-button label="Others">Others</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item prop="others">
                        <label class="m-0">Pls Specify</label>
                        <el-input v-if="addPatient.familyMember=='Others'" v-model="addPatient.others"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="5">
                    <el-form-item prop="Philhealth">
                        <label class="m-0"><span class="text-danger">*</span> Philhealth Type</label>
                        <el-radio-group v-model="addPatient.Philhealth" size="medium">
                            <el-radio-button label="Member">Member</el-radio-button>
                            <el-radio-button label="Dependent">Dependent</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item prop="philhealthNo">
                        <label class="m-0">Philhealth No.</label>
                        <el-input v-model="addPatient.philhealthNo" maxlength="14" id="myinput" OnInput="add_hyphen()"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="7">
                    <el-form-item prop="motherlastName">
                        <label class="m-0"><span class="text-danger">*</span>Mother Last Name</label>
                        <el-input v-model="addPatient.motherlastName"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="7">
                    <el-form-item prop="motherfirstName">
                        <label class="m-0"><span class="text-danger">*</span>Mother First Name</label>
                        <el-input v-model="addPatient.motherfirstName"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="6">
                    <el-form-item prop="middleName">
                        <label class="m-0">Mother Middle Name</label>
                        <el-input v-model="addPatient.mothermiddleName" clearable></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="5">
                    <el-form-item prop="nhts">
                        <label class="m-0"><span class="text-danger">*</span> NHTS Member</label>
                        <el-radio-group v-model="addPatient.nhts" size="medium">
                            <el-radio-button label="yes">Yes</el-radio-button>
                            <el-radio-button label="no">No</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item prop="pantawid">
                        <label class="m-0"><span class="text-danger">*</span> Pantawid Pamilya Member</label>
                        <el-radio-group v-model="addPatient.pantawid" size="medium">
                            <el-radio-button label="yes">Yes</el-radio-button>
                            <el-radio-button label="no">No</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item prop="pantawidMember">
                        <label class="m-0">If yes, HH no.</label>
                        <el-input v-if="addPatient.pantawid=='yes'" v-model="addPatient.pantawidMember"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="6">
                    <el-form-item prop="alertType">
                        <label class="m-0"><span class="text-danger">*</span>Alert Type</label>
                        <el-select v-model="addPatient.alertType">
                            <el-option value="Allergy" label="Allergy"></el-option>
                            <el-option value="Disability" label="Disability"></el-option>
                            <el-option value="Drug" label="Drug"></el-option>
                            <el-option value="Handicap" label="Handicap"></el-option>
                            <el-option value="Impairment" label="Impairment"></el-option>
                            <el-option value="Others" label="Others"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item prop="others">
                        <label class="m-0">Others</label>
                        <el-input v-if="addPatient.alertType=='Others'" v-model="addPatient.others"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="10">
                    <el-form-item prop="medicalHistory">
                        <label class="m-0"><span class="text-danger">*</span>Past medical family history</label>
                        <el-radio-group v-model="addPatient.medicalHistory" size="medium">
                            <el-radio-button label="HPN">HPN</el-radio-button>
                            <el-radio-button label="DM">DM</el-radio-button>
                            <el-radio-button label="Asthma">Asthma</el-radio-button>
                            <el-radio-button label="Smoker">Smoker</el-radio-button>
                            <el-radio-button label="Others">Others</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item prop="others">
                        <label class="m-0">Others</label>
                        <el-input v-if="addPatient.medicalHistory=='Others'" v-model="addPatient.others"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <div>
                <hr class="dropdown-divider border border-dark" />
            </div>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="10">
                    <el-form-item prop="encounter">
                        <label class="m-0"><span class="text-danger">*</span>Type of Encounter</label>
                        <el-radio-group v-model="addPatient.encounter" size="medium">
                            <el-radio-button label="Consultation">Consultation</el-radio-button>
                            <el-radio-button label="New Admission">New Admission</el-radio-button>
                            <el-radio-button label="For Follow-up">For Follow-up</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="10">
                    <el-form-item prop="consultationType">
                        <label class="m-0"><span class="text-danger">*</span>Type of Consultation / Purpose of Visit</label>
                        <el-radio-group v-model="addPatient.consultationType" size="medium">
                            <el-radio-button label="General">General</el-radio-button>
                            <el-radio-button label="Prenatal">Prenatal</el-radio-button>
                            <el-radio-button label="Child Immunization">Child Immunization</el-radio-button>
                            <el-radio-button label="Others">Others</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item prop="others">
                        <label class="m-0">Others</label>
                        <el-input v-if="addPatient.consultationType=='Others'" v-model="addPatient.others"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="7">
                    <el-form-item prop="consultationDate">
                        <label class="m-0"><span class="text-danger">*</span>Consultation Date</label>
                        <el-date-picker v-model="addPatient.consultationDate" type="date" placeholder="Select date">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
                <el-col :span="2">
                    <el-form-item prop="age">
                        <label class="m-0">Age</label>
                        <el-input v-model="addPatient.age"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" class="mx-3">
                <el-col :span="7">
                    <el-form-item prop="transaction">
                        <label class="m-0"><span class="text-danger">*</span>Mode of Transaction :</label>
                        <el-radio-group v-model="addPatient.transaction" size="medium">
                            <el-radio-button label="Walk-in">Walk-in</el-radio-button>
                            <el-radio-button label="Visited">Visited</el-radio-button>
                            <el-radio-button label="Referral">Referral</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
            </el-row>
            <div class="underline-input">
                <el-row :gutter="20" class="mx-3">
                    <el-col :span="10">
                        <el-form-item prop="Soap">
                            <label class="m-0">S</label>
                            <el-input type="textarea" v-model="addPatient.Soap"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </div>
        </el-form>
    </el-container>
    <el-button class="flex-1" @click="resetForm('addPatient')">Reset Form</el-button>
</div>
<script>
    function add_hyphen() {
        var input = document.getElementById("myinput");
        var str = input.value;
        str = str.replace("-", "");
        if (str.length > 9) {
            str = str.substring(0, 2) + "-" + str.substring(0, 9) + "-" + str.substring(9)
        }

        input.value = str
    }
</script>