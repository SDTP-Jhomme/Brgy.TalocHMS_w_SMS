<?php

$health_request = mysqli_query($db, "SELECT * FROM health_request WHERE id");

while ($health_row = mysqli_fetch_assoc($health_request)) {

    $civil_status = $health_row['civil_status'];
    $spouse = $health_row['spouse'];
    $educ_attainment = $health_row['educ_attainment'];
    $employment_status = $health_row['employment_status'];
    $occupation = $health_row['occupation'];
    $religion = $health_row['religion'];
    $street = $health_row['street'];
    $blood_type = $health_row['blood_type'];
    $family_member = $health_row['family_member'];
    $other_member = $health_row['other_member'];
    $philhealth_type = $health_row['philhealth_type'];
    $philhealth_no = $health_row['philhealth_no'];
    $nhts = $health_row['nhts'];
    $pantawid_member = $health_row['pantawid_member'];
    $hh_no = $health_row['hh_no'];
    $alert_type = $health_row['alert_type'];
    $other_alert = $health_row['other_alert'];
    $medical_history = $health_row['medical_history'];
    $other_history = $health_row['other_history'];
    $m_firstname = $health_row['m_firstname'];
    $m_middlename = $health_row['m_middlename'];
    $m_lastname = $health_row['m_lastname'];
    $purok = $health_row['purok'];
    $barangay = $health_row['barangay'];
}
?>
<h3 class="text-center mb-4">Individual Treatment Form</h3>
<el-main>
    <el-form :model="health" :rules="healthRules" ref="health">
        <div class="underline-input top d-flex justify-content-end">
            <div class="d-flex flex-wrap justify-content-between w-50">
                <div class="w-40">
                    <el-form-item label="FSN :" prop="fsn">
                        <el-input v-model="viewPatient.fsn" size="small" clearable disabled></el-input>
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
            <div class="mb-4" :class="viewPatient.middle_name && !viewPatient.suffix || !viewPatient.middle_name && viewPatient.suffix ? 'w-30' : viewPatient.middle_name && viewPatient.suffix ? 'w-20' : 'w-25'">
                <label class="m-0">First Name</label>
                <el-input v-model="viewPatient.first_name" size="small" clearable disabled></el-input>
            </div>
            <div class="mb-4" :class="viewPatient.middle_name && !viewPatient.suffix || !viewPatient.middle_name && viewPatient.suffix ? 'w-30' : viewPatient.middle_name && viewPatient.suffix ? 'w-20' : 'w-25'">
                <label class="m-0">Last Name</label>
                <el-input v-model="viewPatient.last_name" size="small" clearable disabled></el-input>
            </div>
            <div v-if="viewPatient.middle_name != 'undefined'" class="mb-4" :class="viewPatient.middle_name && !viewPatient.suffix ? 'w-30' : viewPatient.middle_name && viewPatient.suffix ? 'w-20' : 'w-25'">
                <label class="m-0">Middle Name</label>
                <el-input v-model="viewPatient.middle_name" size="small" clearable disabled></el-input>
            </div>
            <div v-if="viewPatient.suffix != 'undefined'" class="mb-4" :class="!viewPatient.middle_name && viewPatient.suffix ? 'w-10' : viewPatient.middle_name && viewPatient.suffix ? 'w-10' : 'w-25'">
                <label class="m-0">Suffix</label>
                <el-input v-model="viewPatient.suffix" size="small" clearable disabled></el-input>
            </div>
            <div class="d-flex flex-wrap" :class="viewPatient.middle_name || viewPatient.suffix ? 'w-50 justify-content-evenly' : 'w-40 justify-content-between'">
                <div class="mb-4 birth-width" :class="viewPatient.middle_name && viewPatient.suffix || viewPatient.middle_name || viewPatient.suffix ? 'w-50' : 'w-65'">
                    <label class="m-0">Birthdate</label>
                    <el-date-picker v-model="viewPatient.birthdate" type="date" size="small" placeholder="" disabled>
                    </el-date-picker>
                </div>
                <div class="mb-4" :class="!viewPatient.middle_name && !viewPatient.suffix ? 'w-30' : 'w-20'">
                    <label class="m-0">Gender</label>
                    <el-input v-model="viewPatient.gender" size="small" clearable disabled></el-input>
                </div>
            </div>
        </div>
        <!-- End -->

        <div>
            <el-divider></el-divider>
        </div>
        <div class="fs-6">
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Civil Status :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $civil_status ?>" size="small" clearable disabled></el-input>
                </div>
                <div class="col-auto">
                    <label for="">Spouse (If married) :</label>
                </div>
                <div class="col-auto mb-4">
                    <el-input value="<?php echo $spouse ?>" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Educational Attainment :</label>
                </div>
                <div class="col-auto">
                    <el-radio-group value="<?php echo $educ_attainment ?>" size="small" clearable disabled>
                        <el-radio label="Elementary">Elementary</el-radio>
                        <el-radio label="High School">High School</el-radio>
                        <el-radio label="College">College</el-radio>
                        <el-radio label="Post Grad">Post Grad</el-radio>
                        <el-radio label="No Formal Educ.">No Formal Educ.</el-radio>
                    </el-radio-group>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Employment Status :</label>
                </div>
                <div class="col-auto">
                    <el-radio-group value="<?php echo $employment_status ?>" size="small" clearable disabled>
                        <el-radio label="Student">Student</el-radio>
                        <el-radio label="Unemployed">Unemployed</el-radio>
                        <el-radio label="Employed">Employed</el-radio>
                    </el-radio-group>
                </div>
                <div class="col-3">
                    <label for="">(Occupation if employed) :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $occupation ?>" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Religion :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $religion ?>" size="small" clearable disabled></el-input>
                </div>
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Telephone (Mobile/Landline/Email) :</label>
                </div>
                <div class="col-auto">
                    <el-input v-model="viewPatient.phone_number" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Number/Street Name :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $street ?>" size="small" clearable disabled></el-input>
                </div>
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Purok :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $purok ?>" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Barangay :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $barangay ?>" size="small" clearable disabled></el-input>
                </div>
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Blood Type :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $blood_type ?>" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Family Member :</label>
                </div>
                <div class="col-auto">
                    <el-radio-group value="<?php echo $family_member ?>" size="small" clearable disabled>
                        <el-radio label="Father">Father</el-radio>
                        <el-radio label="Mother">Mother</el-radio>
                        <el-radio label="Son">Son</el-radio>
                        <el-radio label="Daughter">Daughter</el-radio>
                        <el-radio label="Others">Others:</el-radio>
                    </el-radio-group>
                </div>
                <div class="col-2">
                    <label for="">Please specify :</label>
                </div>
                <div class="col-2">
                    <el-input value="<?php echo $other_member ?>" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>PhilHealth Type :</label>
                </div>
                <div class="col-auto">
                    <el-radio-group value="<?php echo $philhealth_type ?>" size="small" clearable disabled>
                        <el-radio label="Member">Member</el-radio>
                        <el-radio label="Dependent">Dependent</el-radio>
                    </el-radio-group>
                </div>
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>PhilHealth Number :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $philhealth_no ?>" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-2">
                    <label for=""><span class="text-danger">*</span>Mother Last Name :</label>
                </div>
                <div class="col-2">
                    <el-input value="<?php echo $m_lastname ?>" size="small" clearable disabled></el-input>
                </div>
                <div class="col-2">
                    <label for=""><span class="text-danger">*</span>Mother First Name :</label>
                </div>
                <div class="col-2">
                    <el-input value="<?php echo $m_firstname ?>" size="small" clearable disabled></el-input>
                </div>
                <div class="col-2">
                    <label for="">Mother Middle Name :</label>
                </div>
                <div class="col-2">
                    <el-input value="<?php echo $m_middlename ?>" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for="">NHTS Member :</label>
                </div>
                <div class="col-auto">
                    <el-radio-group value="<?php echo $nhts ?>" size="small" clearable disabled>
                        <el-radio label="Yes">Yes</el-radio>
                        <el-radio label="No">No</el-radio>
                    </el-radio-group>
                </div>
                <div class="col-auto">
                    <label for="">Pantawid Pamilya Member :</label>
                </div>
                <div class="col-auto">
                    <el-radio-group value="<?php echo $pantawid_member ?>" size="small" clearable disabled>
                        <el-radio label="Yes">Yes</el-radio>
                        <el-radio label="No">No</el-radio>
                    </el-radio-group>
                </div>
                <div class="col-auto">
                    <label for="">If yes, HH no. :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $hh_no ?>" id="hhno" OnInput="add_hyphen()" maxlength="14" clearable></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Alert Type :</label>
                </div>
                <div class="col-auto">
                    <el-select value="<?php echo $alert_type ?>" placeholder="Select" size="small" clearable disabled>
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
                </div>
                <div class="col-auto">
                    <label for="">Others :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $other_alert ?>" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Past medical family history :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $medical_history ?>" size="small" clearable disabled></el-input>
                </div>
                <div class="col-auto">
                    <label for="">Others :</label>
                </div>
                <div class="col-auto">
                    <el-input value="<?php echo $other_history ?>" size="small" clearable disabled></el-input>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Type of Encounter / (OPD) : (Pls. Check) :</label>
                </div>
                <div class="col-auto">
                    <el-form-item class="radio normal" prop="encounter">
                        <el-radio-group v-model="health.encounter">
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
                        <el-select v-model="health.consultationType" placeholder="Select" clearable>
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
                        <el-input v-model="health.otherConsultation" :disabled="health.consultationType != 'Others'" clearable></el-input>
                    </el-form-item>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for="">Consultaion Date :</label>
                </div>
                <div class="col-auto">
                    <el-form-item prop="appointment">
                        <el-input v-model="health.appointment" clearable disabled></el-input>
                    </el-form-item>
                </div>
                <div class="col-auto">
                    <label for="">Age :</label>
                </div>
                <div class="col-auto">
                    <el-form-item prop="age">
                        <el-input v-model="health.age" clearable disabled></el-input>
                    </el-form-item>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for=""><span class="text-danger">*</span>Mode of Transaction : (Pls. Check) :</label>
                </div>
                <div class="col-auto">
                    <el-form-item class="radio normal" prop="transaction">
                        <el-radio-group v-model="health.transaction">
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
                        <el-input v-model="health.s" clearable></el-input>
                    </el-form-item>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for="">O :</label>
                </div>
                <div class="col-auto">
                    <el-form-item prop="s">
                        <el-input v-model="health.o" clearable></el-input>
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
                            <el-input v-model="health.rr" clearable>
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
                            <el-input v-model="health.bp" clearable>
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
                            <el-input v-model="health.weight" clearable>
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
                            <el-input v-model="health.height" clearable>
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
                            <el-input v-model="health.temp" clearable>
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
                        <el-input v-model="health.a" clearable></el-input>
                    </el-form-item>
                </div>
            </div>
            <div class="row g-3 mt-5">
                <div class="col-auto">
                    <label for="">P :</label>
                </div>
                <div class="col-auto">
                    <el-form-item prop="p">
                        <el-input v-model="health.p" clearable></el-input>
                    </el-form-item>
                </div>
            </div>
        </div>
    </el-form>
</el-main>