<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Individual Treatment</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["id"])) {

        $id = $_SESSION["id"];
        $time = time();
        $admin_record = mysqli_query($db, "SELECT * FROM admin where id='$id'");

        while ($admin_row = mysqli_fetch_assoc($admin_record)) {

            $db_username = $admin_row["username"];
            $logged_admin = ucfirst($db_username);
        }
    } else {

        header("Location: ./login");
        die();
    } ?>
</head>

<body class="sb-nav-fixed">
    <div id="app">
        <?php include("./import/nav.php"); ?>
        <div id="layoutSidenav" v-loading.fullscreen.lock="fullscreenLoading">
            <?php include("./import/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <el-container>
                        <el-main>
                            <el-header class="mt-4" height="40">
                                <h1 class="mt-4">Individual Treatment Table</h1>
                                <div class="card mb-4">
                                    <div class="card-body text-primary">
                                        Barangay Taloc Online Health Record Management System <?php echo date("Y"); ?>
                                    </div>
                                </div>
                            </el-header>
                            <div class="container border rounded p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex">
                                        <el-select v-model="searchValue" size="mini" placeholder="Select Column" @changed="changeColumn" clearable>
                                            <el-option v-for="search in options" :key="search.value" :label="search.label" :value="search.value">
                                            </el-option>
                                        </el-select>
                                        <div class="ps-2">
                                            <div v-if="searchValue == 'fsn'">
                                                <el-input v-model="searchID" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else-if="searchValue == 'name'">
                                                <el-input v-model="searchName" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else-if="searchValue == 'birthdate'">
                                                <el-input v-model="searchBirthday" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else>
                                                <el-input v-model="searchNull" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <el-table v-if="this.tableData" :data="usersTable" style="width: 100%" border @selection-change="handleSelectionChange" height="400" v-loading="tableLoad" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading">
                                    <el-table-column type="selection" width="55">
                                    </el-table-column>
                                    <el-table-column label="No." type="index" width="50">
                                    </el-table-column>
                                    <el-table-column sortable label="FSN No." prop="fsn">
                                    </el-table-column>
                                    <el-table-column label="Date Visited" prop="date">
                                    </el-table-column>
                                    <el-table-column label="Name" width="220" prop="name">
                                    </el-table-column>
                                    <el-table-column label="Birthday" width="150" prop="birthdate">
                                    </el-table-column>
                                    <el-table-column label="Purok" prop="address">
                                    </el-table-column>
                                    <el-table-column label="Phone No." prop="phone_number">
                                    </el-table-column>
                                    <el-table-column label="Gender" prop="gender" width="110" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
                                        <template slot-scope="scope">
                                            <el-tag size="small" v-if="scope.row.gender == 'Male'">{{ scope.row.gender }}</el-tag>
                                            <el-tag size="small" v-else type="danger">{{ scope.row.gender }}</el-tag>
                                        </template>
                                    </el-table-column>
                                    <el-table-column fixed="right" label="Actions" width="200">
                                        <template slot-scope="scope">
                                            <el-tooltip class="item" effect="dark" content="View Details" placement="top-start">
                                                <el-button icon="el-icon-view" size="mini" type="warning" @click="handleView(scope.$index, scope.row)">View Details</el-button>
                                            </el-tooltip>
                                            <el-tooltip class="item" effect="dark" content="Update Phone No." placement="top-start">
                                                <el-button icon="el-icon-edit" size="mini" type="primary" @click="handleEdit(scope.$index, scope.row)"></el-button>
                                            </el-tooltip>
                                        </template>
                                    </el-table-column>
                                </el-table>
                                <div class="d-flex justify-content-between mt-2">
                                    <el-checkbox v-model="showAllData">Show All</el-checkbox>
                                    <el-pagination :current-page.sync="page" :pager-count="5" :page-size="this.pageSize" background layout="prev, pager, next" :total="this.tableData.length" @current-change="setPage">
                                    </el-pagination>
                                </div>
                            </div>
                        </el-main>

                        <!----------------------------------------------------------------------------------- Modals/Drawers ----------------------------------------------------------------------------------->
                        <!-- Reset Password Dialog -->
                        <el-dialog title="BHW Username and New Password" :visible.sync="openResetDialog" width="30%" :before-close="closeResetDialog">
                            <label>Username</label>
                            <el-input class="mb-2" v-model="resetUser.username" disabled></el-input>
                            <label>New Password</label>
                            <el-input class="mb-2" v-model="resetUser.password" disabled></el-input>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" @click="closeResetDialog">Close</el-button>
                            </span>
                        </el-dialog>

                        <!-- View Dialog -->
                        <el-dialog :visible.sync="viewDialog" width="70%" :before-close="closeViewDialog">
                            <template #title>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="pe-4">
                                        <el-avatar :size="70" :src="viewPrenatal.avatar"></el-avatar>
                                    </div>
                                </div>
                            </template>
                            <div class="container">
                                <div class="" id="printThis">
                                    <div class="mx-4">
                                        <div class="row d-flex justify-content-center mb-2">
                                            <div class="col-auto">
                                                <h6>CITY HEALTH OFFICE</h6>
                                            </div>
                                        </div>
                                        <div class="row" style="position: relative; left:46%; right:50%;">
                                            <div class="col-4">
                                                <h6>Bago City</h6>
                                            </div>
                                            <div class="col-3">
                                                <label for="">FSN : <span class="border-bottom border-dark px-5">{{viewPrenatal.fsn}}</span></label>
                                            </div>
                                        </div>
                                        <div class="row" style="position: relative; left:39%; right:50%;">
                                            <div class="col-5">
                                                <h6>INDIVIDUAL TREATMENT RECORD</h6>
                                            </div>
                                            <div class="col-3">
                                                <label for="">Clinisys FSN : <span class="border-bottom border-dark px-5">{{viewPrenatal.clinisys}}</label>
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <div class="row mb-3">
                                                <div class="col-auto">
                                                    <label for="">Last Name: <span class="border-bottom border-dark px-5">{{viewPrenatal.last_name}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">First Name: <span class="border-bottom border-dark px-5">{{viewPrenatal.first_name}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Middle Name: <span class="border-bottom border-dark px-5">{{viewPrenatal.middle_name}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Suffix: <span class="border-bottom border-dark px-5">{{viewPrenatal.suffix}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Date of Birth: <span class="border-bottom border-dark px-5">{{viewPrenatal.birthdate}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Gender:
                                                        <el-radio-group v-model="viewPrenatal.gender">
                                                            <el-radio label="Male" disabled>Male</el-radio>
                                                            <el-radio label="Female" disabled>Female</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Civil Status: <span class="border-bottom border-dark px-5">{{viewPrenatal.civil_status}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Spouse(if married : <span class="border-bottom border-dark px-5">{{viewPrenatal.spouse}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Educational Attainment (Pls.Check):
                                                        <el-radio-group v-model="viewPrenatal.educ_attainment">
                                                            <el-radio label="Elementary" disabled>Elementary</el-radio>
                                                            <el-radio label="High School" disabled>High School</el-radio>
                                                            <el-radio label="College" disabled>College</el-radio>
                                                            <el-radio label="Post Grad" disabled>Post Grad</el-radio>
                                                            <el-radio label="No Formal Educ" disabled>No Formal Educ</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Employment Status (Pls.Check):
                                                        <el-radio-group v-model="viewPrenatal.employment_status">
                                                            <el-radio label="Student" disabled>Student</el-radio>
                                                            <el-radio label="Unemployed" disabled>Unemployed</el-radio>
                                                            <el-radio label="Employed" disabled>Employed</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">(Occupation if employed): <span class="border-bottom border-dark px-5">{{viewPrenatal.occupation}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Religion: <span class="border-bottom border-dark px-5">{{viewPrenatal.religion}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Telephone :(Mobile/Landline/Email): <span class="border-bottom border-dark px-5">{{viewPrenatal.phone_number}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Number/Street Name: <span class="border-bottom border-dark px-5">{{viewPrenatal.street}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Purok: <span class="border-bottom border-dark px-5">{{viewPrenatal.address}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Barangay: <span class="border-bottom border-dark px-5">{{viewPrenatal.barangay}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Blood Type: <span class="border-bottom border-dark px-5">{{viewPrenatal.blood_type}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Family Member (Pls.Check):
                                                        <el-radio-group v-model="viewPrenatal.family_member">
                                                            <el-radio label="Father" disabled>Father</el-radio>
                                                            <el-radio label="Mother" disabled>Mother</el-radio>
                                                            <el-radio label="Son" disabled>Son</el-radio>
                                                            <el-radio label="Daughter" disabled>Daughter</el-radio>
                                                            <el-radio label="Others" disabled>Others</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Other : Pls.specify: <span class="border-bottom border-dark px-5">{{viewPrenatal.other_member}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Philhealth Type:
                                                        <el-radio-group v-model="viewPrenatal.philhealth_type">
                                                            <el-radio label="Member" disabled>Member</el-radio>
                                                            <el-radio label="Dependent" disabled>Dependent</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Philhealth No: <span class="border-bottom border-dark px-5">{{viewPrenatal.philhealth_no}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Mother Last Name: <span class="border-bottom border-dark px-5">{{viewPrenatal.m_lastname}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Mother First Name: <span class="border-bottom border-dark px-5">{{viewPrenatal.m_firstname}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Mother Middle Name: <span class="border-bottom border-dark px-5">{{viewPrenatal.m_middlename}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">NHTS Member:
                                                        <el-radio-group v-model="viewPrenatal.nhts">
                                                            <el-radio label="Yes" disabled>Yes</el-radio>
                                                            <el-radio label="No" disabled>No</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Pantawid Pamilya Member:
                                                        <el-radio-group v-model="viewPrenatal.pantawid_member">
                                                            <el-radio label="Yes" disabled>Yes</el-radio>
                                                            <el-radio label="No" disabled>No</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">If yes, HH no: <span class="border-bottom border-dark px-5">{{viewPrenatal.hh_no}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-4">
                                                    <label for="">Alert Type : Allergy: <span class="border-bottom border-dark px-5">{{viewPrenatal.alert_type}}</span></label>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Disablity: <span class="border-bottom border-dark px-5">{{viewPrenatal.alert_type}}</span></label>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Drug: <span class="border-bottom border-dark px-5">{{viewPrenatal.alert_type}}</span></label>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Handicap: <span class="border-bottom border-dark px-5">{{viewPrenatal.alert_type}}</span></label>
                                                </div>
                                                <div class="ms-5 col-3">
                                                    <label for="">Impairment: <span class="border-bottom border-dark px-5">{{viewPrenatal.alert_type}}</span></label>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Others: <span class="border-bottom border-dark px-5">{{viewPrenatal.other_alert}}</span></label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Past mediical family history:
                                                        <el-radio-group v-model="viewPrenatal.medical_history">
                                                            <el-radio label="HPN" disabled>HPN</el-radio>
                                                            <el-radio label="DM" disabled>DM</el-radio>
                                                            <el-radio label="Asthma" disabled>Asthma</el-radio>
                                                            <el-radio label="Smoker" disabled>Smoker</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Others: <span class="border-bottom border-dark px-5">{{viewPrenatal.other_history}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 border-top border-dark">
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for=""> Type of Encounter/ (OPD) : (Pls. Check):
                                                        <el-radio-group v-model="viewPrenatal.encounter_type">
                                                            <el-radio label="Consultation" disabled>Consultation</el-radio>
                                                            <el-radio label="New Admission" disabled>New Admission</el-radio>
                                                            <el-radio label="For follow-up" disabled>For follow-up</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for=""> Type of Consultation/ Purpose of Visit:
                                                        <el-radio-group v-model="viewPrenatal.consultation_type">
                                                            <el-radio label="General" disabled>General</el-radio>
                                                            <el-radio label="Family Planning" disabled>Family Planning</el-radio>
                                                            <el-radio label="Chld Care" disabled>Chld Care</el-radio>
                                                            <el-radio label="Child Nutrition" disabled>Child Nutrition</el-radio>
                                                            <el-radio label="Prenatal" disabled>Prenatal</el-radio>
                                                            <el-radio label="Dental Care" disabled>Dental Care</el-radio>
                                                            <el-radio label="Sick Children" disabled>Sick Children</el-radio>
                                                            <el-radio label="Injury" disabled>Injury</el-radio>
                                                            <el-radio label="Post-Partum" disabled>Post-Partum</el-radio>
                                                            <el-radio label="Tuberculosis" disabled>Tuberculosis</el-radio>
                                                            <el-radio label="Child Immunization" disabled>Child Immunization</el-radio>
                                                            <el-radio label="Firecracker Injury" disabled>Firecracker Injury</el-radio>
                                                            <el-radio label="Others" disabled>Others</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Consultation Date: <span class="border-bottom border-dark px-5">{{viewPrenatal.consultation_date}}</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="">Age: <span class="border-bottom border-dark px-5">{{viewPrenatal.age}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">Mode of Transaction : (Pls. Check):
                                                        <el-radio-group v-model="viewPrenatal.transaction_mode">
                                                            <el-radio label="Walk-in" disabled>Walk-in</el-radio>
                                                            <el-radio label="Visited" disabled>Visited</el-radio>
                                                            <el-radio label="Referral" disabled>Referral</el-radio>
                                                        </el-radio-group>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">S: <span class="border-bottom border-dark px-5">{{viewPrenatal.s}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">O: <span class="border-bottom border-dark px-5">{{viewPrenatal.o}}</label>
                                                </div>
                                            </div>
                                            <div class="ms-5">
                                                <div class="row g-2 mb-3">
                                                    <div class="col-auto">
                                                        <label for="">PR / CR: <span class="border-bottom border-dark px-5">{{viewPrenatal.pr}}</label>
                                                    </div>
                                                </div>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-auto">
                                                        <label for="">RR: <span class="border-bottom border-dark px-5">{{viewPrenatal.rr}}</label>
                                                    </div>
                                                </div>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-auto">
                                                        <label for="">BP: <span class="border-bottom border-dark px-5">{{viewPrenatal.bp}}</label>
                                                    </div>
                                                </div>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-auto">
                                                        <label for="">Weight: <span class="border-bottom border-dark px-5">{{viewPrenatal.weight}}</label>
                                                    </div>
                                                </div>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-auto">
                                                        <label for="">Height: <span class="border-bottom border-dark px-5">{{viewPrenatal.height}}</label>
                                                    </div>
                                                </div>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-auto">
                                                        <label for="">Temp: <span class="border-bottom border-dark px-5">{{viewPrenatal.temp}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">A: <span class="border-bottom border-dark px-5">{{viewPrenatal.a}}</label>
                                                </div>
                                            </div>
                                            <div class="row g-2 mb-3">
                                                <div class="col-auto">
                                                    <label for="">P: <span class="border-bottom border-dark px-5">{{viewPrenatal.p}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" icon="el-icon-printer" id="Print">Print</el-button>
                                <el-button type="info" @click="closeViewDialog">Close</el-button>
                            </span>
                        </el-dialog>

                        <!-- Edit Dialog -->
                        <el-dialog :visible.sync="editDialog" width="40%" :before-close="closeEditDialog">
                            <template #title>
                                Edit User {{ editBhw.username }}
                            </template>
                            <el-descriptions direction="horizontal" class="mb-4" :column="1" border>
                                <el-descriptions-item label="FSN">{{ editBhw.fsn }}</el-descriptions-item>
                            </el-descriptions>
                            <el-form :label-position="leftLabel" label-width="160px" :model="updateContact" :rules="editRules" ref="updateContact">
                                <el-form-item label="Phone Number" prop="phone_number">
                                    <el-input v-model="updateContact.phone_number" maxlength="11" clearable show-phone_number></el-input>
                                </el-form-item>
                            </el-form>
                            <span slot="footer" class="dialog-footer">
                                <el-button :loading="loadButton" @click="closeEditDialog('updateContact')">Cancel</el-button>
                                <el-button :loading="loadButton" type="warning" @click="resetPassword">Reset Password</el-button>
                                <el-button :loading="loadButton" type="primary" @click="updateUser('updateContact')">Update</el-button>
                            </span>
                        </el-dialog>
                        <!----------------------------------------------------------------------------------- End of Modals/Drawers ----------------------------------------------------------------------------------->
                    </el-container>
                </main>
                <?php include("./import/footer.php"); ?>
            </div>
        </div>
    </div>
    <?php include("./import/body.php"); ?>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#app",
            data() {
                return {
                    editRules: {
                        phone_number: [{
                            required: true,
                            message: 'Phone no. is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^(09|\+639)\d{9}$/,
                            message: 'Invalid phone number format!',
                            trigger: 'blur'
                        }, {
                            min: 11,
                            message: 'Phone number should eleven(11) digits!',
                            trigger: 'blur'
                        }],
                    },
                    page: 1,
                    pageSize: 10,
                    showAllData: false,
                    searchValue: "",
                    searchNull: "",
                    searchName: "",
                    searchID: "",
                    searchBirthday: "",
                    topLabel: "top",
                    leftLabel: "left",
                    tableLoad: false,
                    openResetDialog: false,
                    loadButton: false,
                    editDialog: false,
                    viewDialog: false,
                    multipleSelection: [],
                    fullscreenLoading: true,
                    tableData: [],
                    multiID: [],
                    resetUser: [],
                    checkIdentification: [],
                    editBhw: [],
                    viewPrenatal: [],
                    updateContact: {
                        id: 0,
                        phone_number: "",
                    },
                    options: [{
                        value: 'fsn',
                        label: 'FSN No.'
                    }, {
                        value: 'name',
                        label: 'Name'
                    }, {
                        value: 'birthdate',
                        label: 'Birthday'
                    }]
                }
            },
            computed: {
                usersTable() {
                    return this.tableData
                        .filter((data) => {
                            return data.name.toLowerCase().includes(this.searchName.toLowerCase());
                        })
                        .filter((data) => {
                            return data.fsn.toLowerCase().includes(this.searchID.toLowerCase());
                        })
                        .filter((data) => {
                            return data.birthdate.toLowerCase().includes(this.searchBirthday.toLowerCase());
                        })
                        .slice(this.pageSize * this.page - this.pageSize, this.pageSize * this.page)
                }
            },
            created() {
                this.getData()
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
            },
            watch: {
                editBhw(value) {
                    this.updateContact.id = value.id ? value.id : "";
                    this.updateContact.phone_number = value.phone_number ? value.phone_number : "";
                    this.updateContact.fsn = value.fsn ? value.fsn : "";
                },
                searchValue(value) {
                    if (value == "" || value == "fsn" || value == "name" || value == "birthdate") {
                        this.searchNull = '';
                        this.searchID = '';
                        this.searchName = '';
                        this.searchBirthday = '';
                    }
                },
                showAllData(value) {
                    if (value == true) {
                        this.page = 1;
                        this.pageSize = this.tableData.length
                    } else {
                        this.pageSize = 10
                    }
                },
            },
            methods: {
                // Logout ***********************************************
                logout() {
                    this.fullscreenLoading = true
                    axios.post("auth.php?action=logout")
                        .then(response => {
                            if (response.data.message) {
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged out!',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = "login"
                                }, 1000)
                            }
                        })
                },
                // ******************************************************
                handleSelectionChange(val) {
                    this.multiID = Object.values(val).map(i => i.id)
                },
                filterHandler(value, row, column) {
                    const property = column['property'];
                    return row[property] === value;
                },
                closeViewDialog() {
                    this.viewDialog = false;
                },
                closeEditDialog(editBhw) {
                    this.$confirm('Are you sure you want to cancel updating BHW?', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        })
                        .then(() => {
                            this.editDialog = false
                            this.$refs[editBhw].resetFields();
                            localStorage.removeItem("fsn")
                        })
                        .catch(() => {});
                },
                closeResetDialog() {
                    this.$confirm('Done copying new password?', 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.openResetDialog = false
                        })
                        .catch(() => {});
                },
                setPage(value) {
                    this.page = value
                },
                getData() {
                    axios.post("action.php?action=fetch_health")
                        .then(response => {
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
                                this.checkIdentification = response.data.map(res => res.fsn)
                            }
                        })
                },
                handleView(index, row) {
                    this.viewPrenatal = row;
                    this.viewDialog = true;
                },
                handleEdit(index, row) {
                    localStorage.setItem("fsn", row.fsn)
                    this.editBhw = {
                        id: row.id,
                        phone_number: row.phone_number,
                        fsn: row.fsn,
                        username: row.username,
                        firstName: row.first_name,
                    }
                    this.editDialog = true;
                },
                updateUser(updateContact) {
                    this.$refs[updateContact].validate((valid) => {
                        if (valid) {
                            if (this.editBhw.phone_number != this.updateContact.phone_number) {
                                this.loadButton = true;
                                this.$confirm('This will update user ' + this.editBhw.firstName + '. Continue?', {
                                        confirmButtonText: 'Confirm',
                                        cancelButtonText: 'Cancel',
                                    })
                                    .then(() => {
                                        this.editDialog = false;
                                        var updateData = new FormData()
                                        updateData.append("id", this.updateContact.id)
                                        updateData.append("phone_number", this.updateContact.phone_number)
                                        axios.post("action.php?action=update_contact", updateData)
                                            .then(response => {
                                                if (response.data) {
                                                    this.loadButton = false;
                                                    this.tableLoad = true;
                                                    setTimeout(() => {
                                                        this.tableLoad = false;
                                                        this.getData();
                                                        this.$message({
                                                            message: 'Phone no. has been updated successfully!',
                                                            type: 'success'
                                                        });
                                                    }, 1500)
                                                }
                                            })
                                        localStorage.removeItem("fsn")
                                    })
                                    .catch(() => {
                                        this.loadButton = false;
                                    });
                            } else {
                                this.$confirm('No changes made. Cancel editing user?', {
                                        confirmButtonText: 'Yes',
                                        cancelButtonText: 'No',
                                    })
                                    .then(() => {
                                        this.editDialog = false
                                        localStorage.removeItem("fsn")
                                    })
                                    .catch(() => {
                                        this.editDialog = true
                                    })
                            }
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    });
                },
                resetPassword() {
                    this.loadButton = true;
                    this.$confirm('This will reset user ' + this.editBhw.username + "'s password. Continue?", 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.editDialog = false;
                            var data = new FormData();
                            data.append("id", this.editBhw.id)
                            data.append("username", this.editBhw.username)
                            axios.post("action.php?action=reset", data)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        localStorage.removeItem("fsn")
                                        setTimeout(() => {
                                            this.tableLoad = false;
                                            this.$message({
                                                message: 'Password has been reset successfully!',
                                                type: 'success'
                                            });
                                            setTimeout(() => {
                                                this.openResetDialog = true;
                                            }, 1500)
                                        }, 1500);
                                        this.resetUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                        })
                        .catch(() => {
                            this.loadButton = false;
                        });
                },
                changeColumn(selected) {
                    this.searchNull = ""
                    this.searchName = ""
                    this.searchID = ""
                    this.searchBirthday = ""
                }
            }
        })
    </script>
    <script>
        document.getElementById("Print").onclick = function() {
            printElement(document.getElementById("printThis"));
        };

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    </script>
</body>

</html>