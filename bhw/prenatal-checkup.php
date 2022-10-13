<div>
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center">Prenatal Form</h3>
            <el-main>
                <el-form :model="addPatient" :label-position="labelPosition" :rules="addRules" ref="addPatient">
                    <el-row :gutter="20" type="flex" justify="center">
                        <el-col :span="6">
                            <el-form-item class="el-item-form" prop="lastName">
                                <label class="m-0">Last Name</label>
                                <el-input v-model="addPatient.lastName" size="small" clearable disabled></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="6">
                            <el-form-item class="el-item-form" prop="firstName">
                                <label class="m-0">First Name</label>
                                <el-input v-model="addPatient.firstName" size="small" clearable disabled></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="6">
                            <el-form-item class="el-item-form" prop="middleName">
                                <label class="m-0">Middle Name</label>
                                <el-input v-model="addPatient.middleName" size="small" clearable disabled></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="2">
                            <el-form-item class="el-item-form" prop="suffix">
                                <label class="m-0">Suffix</label>
                                <el-input v-model="addPatient.suffix" size="small" clearable disabled></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row :gutter="30" type="flex" justify="center" align="middle">
                        <el-col :span="6">
                            <el-form-item class="el-item-form" prop="birthDate">
                                <label class="m-0 d-block">Birthdate</label>
                                <el-date-picker v-model="addPatient.birthDate" type="date" size="small" placeholder="" disabled>
                                </el-date-picker>
                            </el-form-item>
                        </el-col>
                        <el-col :span="6">
                            <el-form-item class="el-item-form" prop="gender">
                                <label class="m-0">Gender</label>
                                <div>
                                    <el-radio v-model="addPatient.gender" label="Male" disabled>Male</el-radio>
                                    <el-radio v-model="addPatient.gender" label="Female" disabled>Female</el-radio>
                                </div>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row>
                        <el-divider></el-divider>
                    </el-row>
                    <div class="underline-input">
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3 mt-2">
                            <el-col :span="10">
                                <el-form-item label="Appointment Date :" prop="appointment">
                                    <el-input v-model="addPatient.appointment" clearable disabled></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item label="Date of Prenatal Visit :" prop="dateVisit">
                                    <el-date-picker v-model="addPatient.dateVisit" type="date" placeholder="Pick a date">
                                    </el-date-picker>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3">
                            <el-col :span="10">
                                <el-form-item label="Weight :" prop="appointment">
                                    <el-input v-model="addPatient.dateVisit" clearable></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item class="measurement" label="Blood Pressure :" prop="dateVisit">
                                    <el-input v-model="addPatient.dateVisit" clearable></el-input>
                                    <p>mmHg</p>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3">
                            <el-col :span="10">
                                <el-form-item class="measurement" label="AOG :" prop="dateVisit">
                                    <el-input v-model="addPatient.dateVisit" clearable></el-input>
                                    <p>weeks</p>
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item label="Fundic Height :" prop="appointment">
                                    <el-input v-model="addPatient.dateVisit" clearable></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3">
                            <el-col :span="10">
                                <el-form-item label="FHB :" prop="dateVisit">
                                    <el-input v-model="addPatient.dateVisit" clearable></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item label="Presentation :" prop="appointment">
                                    <el-input v-model="addPatient.dateVisit" clearable></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>