<div>
    <el-container>
        <el-header height="0px"></el-header>
        <div class="body-card-form">
            <div :label-position="labelPosition">
                <h5 class="fw-bolder">City Health Office</h5>
                <h5>Bago City, Negros Occidental</h5>
            </div>
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
                    <el-row :gutter="20" class="mx-3 underline-input">
                        <el-col :span="10">
                            <el-form-item prop="motherlastName" label="Mother Last Name :">
                                <el-input v-model="addPatient.motherlastName"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="10">
                            <el-form-item prop="motherfirstName" label="Mother First Name :">
                                <el-input v-model="addPatient.motherfirstName"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row :gutter="20" class="mx-3 underline-input">
                        <el-col :span="10">
                            <el-form-item prop="fatherlastName" label="Father Last Name :">
                                <el-input v-model="addPatient.fatherlastName"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="10">
                            <el-form-item prop="fatherfirstName" label="Father First Name :">
                                <el-input v-model="addPatient.fatherfirstName"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row :gutter="20" class="mx-3 underline-input">
                        <el-col :span="10">
                            <el-form-item prop="purok" label="Address (Purok) :">
                                <el-input v-model="addPatient.purok"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="10">
                            <el-form-item prop="barangay" label="Barangay :">
                                <el-input v-model="addPatient.barangay"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-divider></el-divider>
                    <div class="underline-input">
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3 mt-2">
                            <el-col :span="10">
                                <el-form-item label="Appointment Date :" prop="appointment">
                                    <el-input v-model="addPatient.appointment" clearable disabled></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3">
                            <el-col :span="5">
                                <el-form-item label="Age :" prop="age">
                                    <el-input v-model="addPatient.age" clearable></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="5">
                                <el-form-item label="Weight :" prop="weight">
                                    <el-input v-model="addPatient.weight" clearable><template slot="append">kgs / lbs</template></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="5">
                                <el-form-item class="measurement" label="Temp :" prop="temp">
                                    <el-input v-model="addPatient.temp" clearable><template slot="append">°C</template></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row :gutter="30" type="flex" justify="center" class="mb-3">
                            <el-col :span="5">
                                <el-form-item prop="immunizationGiven">
                                    <label class="m-0"><span class="text-danger">*</span>Immunization Given :</label>
                                    <el-input v-model="addPatient.immunizationGiven" type="textarea" clearable></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                    </div>
                </el-form>
            </el-main>
        </div>
    </el-container>
</div>