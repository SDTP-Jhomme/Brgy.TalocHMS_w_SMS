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
        <el-form :model="addPatient" :rules="addRules" ref="addPatient">
            <el-row :gutter="20" type="flex" justify="end" align="middle">
                <el-col :span="4" class="me-5">
                    <el-form-item prop="fsn" label="FSN:" label-width="100px">
                        <el-input v-model="addPatient.fsn"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" type="flex" justify="end" align="middle">
                <el-col :span="4" class="me-5">
                    <el-form-item prop="fsn" label="Clinisys FSN:" label-width="100px">
                        <el-input v-model="addPatient.fsn"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" type="flex" justify="center">
                <el-col :span="6">
                    <el-form-item prop="lastName" label="Last Name" label-width="100px">
                        <el-input v-model="addPatient.lastName" :disabled="true"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="6">
                    <el-form-item prop="firstName" label="First Name" label-width="100px">
                        <el-input v-model="addPatient.firstName" :disabled="true"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="6">
                    <el-form-item prop="middleName" label="Middle Name" label-width="100px">
                        <el-input v-model="addPatient.middleName"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item prop="suffix" label="Suffix" label-width="100px">
                        <el-input v-model="addPatient.suffix"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="30" type="flex" justify="center" align="middle">
                <el-col :span="6">
                    <el-form-item prop="birthDate" label="Date of Birth" label-width="115px">
                        <el-date-picker v-model="addPatient.birthDate" type="date" placeholder="" :disabled="true">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
                <el-col :span="6">
                    <el-form-item prop="gender" label="Gender" label-width="115px">
                        <div>
                            <el-radio v-model="addPatient.gender" label="Male" :disabled="true">Male</el-radio>
                            <el-radio v-model="addPatient.gender" label="Female" :disabled="true">Female</el-radio>
                        </div>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item prop="civil" label="Civil Status:" label-width="120px">
                        <el-select v-model="value" placeholder="Select">
                            <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="5">
                    <el-form-item prop="spouse" label="Spouse: " label-width="120px">
                        <div v-if="value == 'Married'">
                            <el-input v-model="Married" placeholder="(if married)" clearable />
                        </div>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" type="flex" justify="center">
                <el-col :span="20">
                    <el-form-item prop="educAttainment" label="Educational Attainment (Pls. Check):" label-width="300px">
                        <div v-model="addPatient.educAttainment">
                            <el-checkbox label="Elementary">Elementary</el-checkbox>
                            <el-checkbox label="High School">High School</el-checkbox>
                            <el-checkbox label="College">College</el-checkbox>
                            <el-checkbox label="Post Grad">Post Grad</el-checkbox>
                            <el-checkbox label="No Formal Educ">No Formal Educ.</el-radio>
                        </div>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="30" type="flex" justify="center" align="middle">
                <el-col :span="25">
                    <el-form-item prop="employmentStatus" label="Employment Status (Pls. Check):" label-width="250px">
                        <div v-model="addPatient.employmentStatus">
                            <el-checkbox label="Student">Student</el-checkbox>
                            <el-checkbox label="Unemployed">Unemployed</el-checkbox>
                            <el-checkbox label="Employed">Employed</el-checkbox>
                            <label for="employmentStatus" class="mx-3">(Occupation if employed):</label>
                            <div v-if="value=='Employed'">
                                <el-input v-model="Employed" placeholder="(Occupation if employed):" clearable />
                            </div>
                        </div>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" type="flex" justify="center">
                <el-col :span="50">
                    <el-form-item prop="religion" label="Religon:" label-width="120px">
                        <el-input v-model="addPatient.religion" clearable></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="50">
                    <el-form-item prop="telephone" label="Telephone:" label-width="120px">
                        <el-input v-model="addPatient.telephone" placeholder="(Mobile/Landline/Email)" clearable></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="30" type="flex" justify="center">
                <el-col :span="50">
                    <el-form-item prop="street" label="Street Name:" label-width="120px">
                        <el-input v-model="addPatient.street" clearable></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="50">
                    <el-form-item prop="purok" label="Purok:" label-width="120px">
                        <el-input v-model="addPatient.purok" clearable></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" type="flex" justify="center">
                <el-col :span="50">
                    <el-form-item prop="barangay" label="Barangay:" label-width="120px">
                        <el-input v-model="addPatient.barangay" clearable></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="50">
                    <el-form-item prop="bloodType" label="Blood Type:" label-width="120px">
                        <el-input v-model="addPatient.bloodType" clearable></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" type="flex" justify="center" align="middle">
                <el-col :span="20">
                    <el-form-item prop="familyMember" label="Family Member (Pls. Check):" label-width="200px">
                        <div v-model="addPatient.familyMember">
                            <el-checkbox label="Father">Father</el-checkbox>
                            <el-checkbox label="Mother">Mother</el-checkbox>
                            <el-checkbox label="Son">Son</el-checkbox>
                            <el-checkbox label="Daughter">Daughter</el-checkbox>
                            <el-checkbox label="Others">Others:</el-checkbox>
                            <label for="familyMember" class="mx-3"> Pls. Specify</label>
                            <div v-if="value == 'Others'">
                                <el-input v-model="addPatient.familyMember" clearable></el-input>
                            </div>
                        </div>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20" type="flex" justify="center" align="middle">
                <el-col :span="20">
                    <el-form-item prop="Philhealth" label="Philhealth Type:" label-width="200px">
                        <div v-model="addPatient.Philhealth">
                            <el-checkbox label="Member">Member</el-checkbox>
                            <el-checkbox label="Dependent">Dependent</el-checkbox>
                            <label for=" Philhealth" class="mx-3"> Philhealth No.:</label>
                            <div v-if="value == 'Member'|'Dependent'">
                                <el-input v-model="addPatient.Philhealth" type="text" clearable></el-input>
                            </div>
                        </div>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
    </el-container>
</div>