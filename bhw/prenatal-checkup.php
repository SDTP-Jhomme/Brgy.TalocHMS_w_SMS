<div>
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <h3 class="text-center">Prenatal Form</h3>
            <el-main>
                <el-form :model="addPatient" :rules="addRules" ref="addPatient">
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
                </el-form>
                <el-row>
                    <el-divider></el-divider>
                </el-row>
                <div class="underline-input">
                    <el-form>
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3 mt-2">
                            <el-col :span="10">
                                <el-form-item label="Appointment Date :" prop="appointment">
                                    <el-input v-model="prenatal.appointment" clearable disabled></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item label="Date of Prenatal Visit :" prop="dateVisit">
                                    <el-date-picker v-model="prenatal.dateVisit" type="date" placeholder="Pick a date">
                                    </el-date-picker>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3">
                            <el-col :span="10">
                                <el-form-item label="Weight :" prop="weight">
                                    <el-input v-model="prenatal.weight" clearable></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item class="measurement" label="Blood Pressure :" prop="blood">
                                    <el-input v-model="prenatal.blood" clearable></el-input>
                                    <p>mmHg</p>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3">
                            <el-col :span="10">
                                <el-form-item class="measurement" label="aog :" prop="dateVisit">
                                    <el-input v-model="prenatal.aog" clearable></el-input>
                                    <p>weeks</p>
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item label="Fundic Height :" prop="height">
                                    <el-input v-model="prenatal.height" clearable></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3">
                            <el-col :span="10">
                                <el-form-item label="FHB :" prop="fhb">
                                    <el-input v-model="prenatal.fhb" clearable></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="10">
                                <el-form-item label="Presentation :" prop="presentation">
                                    <el-input v-model="prenatal.presentation" clearable></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                    </el-form>
                </div>
            </el-main>
        </div>
    </el-container>
</div>