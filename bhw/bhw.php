<div>
    <el-container>
        <el-header height="0px"></el-header>
        <el-main v-if="active == 0">
            <el-row class="mb-3">
                <el-col :span="12" :offset="2">
                    Patient Information
                </el-col>
            </el-row>
            <el-form :model="addPatient" :rules="addRules" ref="addPatient">
                <el-row :gutter="20" type="flex" justify="center">
                    <el-col :span="6">
                        <el-form-item prop="lastName">
                            <label class="m-0"><span class="text-danger">*</span> Last Name</label>
                            <el-input v-model="addPatient.lastName" clearable></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="6">
                        <el-form-item prop="firstName">
                            <label class="m-0"><span class="text-danger">*</span> First Name</label>
                            <el-input v-model="addPatient.firstName" clearable></el-input>
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
                <el-row :gutter="30" type="flex" justify="center" align="middle">
                    <el-col :span="6">
                        <el-form-item prop="birthDate">
                            <label class="m-0 d-block"><span class="text-danger">*</span> Birthdate</label>
                            <el-date-picker v-model="addPatient.birthDate" type="date" placeholder="" :picker-options="birthdayOptions">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :span="6">
                        <el-form-item prop="gender">
                            <label class="m-0"><span class="text-danger">*</span> Gender</label>
                            <div>
                                <el-radio v-model="addPatient.gender" label="Male">Male</el-radio>
                                <el-radio v-model="addPatient.gender" label="Female">Female</el-radio>
                            </div>
                        </el-form-item>
                    </el-col>
                    <el-col :span="4">
                        <el-form-item prop="phoneNo">
                            <label class="m-0"><span class="text-danger">*</span>Mobile Number</label>
                            <el-input v-model="addPatient.phoneNo" id="phone" maxlength="11" placeholder="09*********" clearable></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <!-- <div class="container border rounded p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="py-2">
                        <el-button icon="el-icon-plus" @click="addDialog = true" type="primary" size="mini">Add Patient</el-button>
                    </div>
                    <div class="d-flex">
                        <el-select v-model="searchValue" size="mini" placeholder="Select Column" @changed="changeColumn" clearable>
                            <el-option v-for="search in options" :key="search.value" :label="search.label" :value="search.value">
                            </el-option>
                        </el-select>
                        <div class="ps-2">
                            <div v-if="searchValue == 'name'">
                                <el-input v-model="searchName" size="mini" placeholder="Type to search..." clearable />
                            </div>
                            <div v-else>
                                <el-input v-model="searchNull" size="mini" placeholder="Type to search..." clearable />
                            </div>
                        </div>
                    </div>
                </div>
                <el-table ref="tableData" stripe :data="usersTable" style="width: 100%" border height="400" highlight-current-row @current-change="handleCurrentChange" v-loading="tableLoad" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading">
                    <el-table-column label="No." type="index" width="50">
                    </el-table-column>
                    <el-table-column sortable label="Name" prop="name">
                    </el-table-column>
                    <el-table-column sortable label="Birthdate" prop="birthdate">
                    </el-table-column>
                    <el-table-column sortable label="Phone No." prop="phone_number">
                    </el-table-column>
                    <el-table-column sortable label="Gender" prop="gender" width="110" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
                        <template slot-scope="scope">
                            <el-tag size="small" v-if="scope.row.gender == 'Male'">{{ scope.row.gender }}</el-tag>
                            <el-tag size="small" v-else type="danger">{{ scope.row.gender }}</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column label="Actions" width="140">
                        <template slot-scope="scope">
                            <el-tooltip class="item" effect="dark" content="Proceed" placement="top-start">
                                <el-button icon="el-icon-arrow-right" size="mini" @click="setCurrent(scope.$index, scope.row)" type="primary">Proceed</el-button>
                            </el-tooltip>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="d-flex justify-content-between mt-2">
                    <el-checkbox v-model="showAllData">Show All</el-checkbox>
                    <el-pagination :current-page.sync="page" :pager-count="5" :page-size="this.pageSize" background layout="prev, pager, next" :total="this.tableData.length" @current-change="setPage">
                    </el-pagination>
                </div>
            </div> -->
            <el-divider></el-divider>
        </el-main>
        <el-main v-if="active == 1">
            <el-row class="mb-3">
                <el-col :span="12" :offset="2">
                    Select Checkup
                </el-col>
            </el-row>
            <el-row :gutter="40" type="flex" justify="center">
                <el-col :span="5">
                    <div>
                        <a href="javascript:void(0)" @click="healthCheckup">
                            <div class="card card-overflow-hidden health-checkup" :class="{'card-border-health': this.isHealthCheckup}">
                                <img src="../assets/img/health-checkup.png" alt="Health Checkup">
                                <div :class="this.isHealthCheckup ? 'card-with-hover-active' : 'card-with-hover'">
                                    <div class="card-text-center">
                                        <h4 class="text-center">Health Checkup</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </el-col>
                <el-col :span="5">
                    <div>
                        <a href="javascript:void(0)" @click="immunization">
                            <div class="card card-overflow-hidden immunization-checkup" :class="{'card-border-immunization': this.isImmunization}">
                                <img src="../assets/img/immunization.png" alt="Immunization Checkup">
                                <div :class="this.isImmunization ? 'card-with-hover-active' : 'card-with-hover'">
                                    <div class="card-text-center">
                                        <h4 class="text-center">Immunization Checkup</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </el-col>
                <el-col v-if="addPatient.gender =='Female' && this.age >= '12' && this.age <= '50'" :span="5">
                    <div>
                        <a href="javascript:void(0)" @click="pregnancy">
                            <div class="card card-overflow-hidden pregnancy-checkup" :class="{'card-border-pregnancy': this.isPregnancy}">
                                <img src="../assets/img/pregnancy.png" alt="Pregnancy Checkup">
                                <div :class="this.isPregnancy ? 'card-with-hover-active' : 'card-with-hover'">
                                    <div class="card-text-center">
                                        <h4 class="text-center">Pregnancy Checkup</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </el-col>
                <el-col v-if="addPatient.gender =='Female' && this.age >= '12' && this.age <= '50'" :span="5">
                    <div>
                        <a href="javascript:void(0)" @click="familyPlaninng">
                            <div class="card card-overflow-hidden family-checkup" :class="{'card-border-family': this.isFamily}">
                                <img src="../assets/img/family-planning.png" alt="Family Planning Checkup">
                                <div :class="this.isFamily ? 'card-with-hover-active' : 'card-with-hover'">
                                    <div class="card-text-center">
                                        <h4 class="text-center">Family Planning</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </el-col>
            </el-row>
        </el-main>
        <el-main v-if="active == 2">
            <el-row class="mb-4">
            </el-row>
            <el-row v-if="this.isHealthCheckup" :gutter="30" type="flex" justify="center">
                <?php include("./checkups/health-checkup.php"); ?>
            </el-row>
            <el-row v-if="this.isImmunization" :gutter="30" type="flex" justify="center">
                <?php include("./checkups/immunization-checkup.php"); ?>
            </el-row>
            <el-row v-if="this.isPregnancy" :gutter="30" type="flex" justify="center">
                <?php include("./checkups/prenatal-checkup.php"); ?>
            </el-row>
            <el-row v-if="this.isFamily" :gutter="30" type="flex" justify="center">
                <?php include("./checkups/family-planning.php"); ?>
            </el-row>
        </el-main>
        <el-main v-if="active == 3">
            <el-row v-if="this.currentRow" :gutter="30" type="flex" justify="center">
                <div class="w-60 lg body-card-form">
                    <el-form :model="addSms" :rules="smsRules" ref="addSms">
                        <div class="underline-input top d-flex justify-content-start">
                            <div class="w-40">
                                <el-form-item label="To :" prop="phoneNo">
                                    <el-input v-model="currentRow.phone_number" clearable disabled></el-input>
                                </el-form-item>
                                <el-form-item label="Name :" prop="firstName">
                                    <el-input v-model="currentRow.first_name" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-30 mb-4">
                                <el-form-item label="Appointment" prop="appointment">
                                    <el-date-picker size="medium" v-model="addSms.appointment" type="date" placeholder="Select Date" :picker-options="datePickerOptions">
                                    </el-date-picker>
                                </el-form-item>
                            </div>
                        </div>
                        <div>
                            <el-divider></el-divider>
                        </div>
                        <div class="underline-input top d-flex justify-content-start">
                            <div class="w-80">
                                <el-form-item label="Message :" prop="message">
                                    <el-input v-model="addSms.message" type="textarea" placeholder="Message here" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </el-form>
                </div>
            </el-row>
            <el-row v-else :gutter="30" type="flex" justify="center">
                <div class="w-60 lg body-card-form">
                    <el-form :model="addSms" :rules="smsRules" ref="addSms">
                        <div class="underline-input top d-flex justify-content-start">
                            <div class="w-40">
                                <el-form-item label="To :" prop="phoneNo">
                                    <el-input v-model="addPatient.phoneNo" clearable disabled></el-input>
                                </el-form-item>
                                <el-form-item label="Name :" prop="firstName">
                                    <el-input v-model="addPatient.firstName" clearable disabled></el-input>
                                </el-form-item>
                            </div>
                            <div class="w-30 mb-4">
                                <el-form-item label="Appointment" prop="appointment">
                                    <el-date-picker size="medium" v-model="addSms.appointment" type="date" placeholder="Select Date" :picker-options="datePickerOptions">
                                    </el-date-picker>
                                </el-form-item>
                            </div>
                        </div>
                        <div>
                            <el-divider></el-divider>
                        </div>
                        <div class="underline-input top d-flex justify-content-start">
                            <div class="w-80">
                                <el-form-item label="Message :" prop="message">
                                    <el-input v-model="addSms.message" type="textarea" placeholder="Message here" clearable></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </el-form>
                </div>
            </el-row>
        </el-main>
        <el-main>
            <el-row type="flex" justify="center" class="mt-4 mb-4">
                <el-col>
                    <el-steps :space="800" :active="active" finish-status="success" align-center>
                        <el-step title="Step 1"></el-step>
                        <el-step title="Step 2"></el-step>
                        <el-step title="Finish"></el-step>
                    </el-steps>
                </el-col>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 0">
                <el-button type="primary" size="small" plain @click="proceed('addPatient')">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 1">
                <el-button-group>
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="next">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                </el-button-group>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 2">
                <el-button-group v-if="isHealthCheckup">
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitHealth('health')">Submit</i></el-button>
                </el-button-group>
                <el-button-group v-else-if="isImmunization">
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitImmunization('immunize')">Submit</i></el-button>
                </el-button-group>
                <el-button-group v-else-if="isPregnancy">
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitPrenatal('prenatal')">Submit</i></el-button>
                </el-button-group>
                <el-button-group v-else>
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="submitFamily('family')">Submit</i></el-button>
                </el-button-group>
            </el-row>
            <el-row type="flex" justify="center" v-if="active == 3">
                <el-button-group>
                    <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                    <el-button type="primary" size="small" plain @click="sendSms('addSms')">Send <i class="el-icon-s-promotion"></i></el-button>
                </el-button-group>
            </el-row>
        </el-main>
    </el-container>
</div>