<!DOCTYPE html>
<html lang="en">

<head>
    <title>BHW | Add Patient</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["user_id"])) {

        $id = $_SESSION["user_id"];

        $user_record = mysqli_query($db, "SELECT * FROM users where id='$id'");

        $user_row = mysqli_fetch_assoc($user_record);

        $db_username = $user_row["username"];
        $db_identification = $user_row["bhw_id"];
        $name = ucfirst($user_row["first_name"]) . " " . ucfirst($user_row["last_name"]);
        $db_last_login = $user_row["last_login"];
        $logged_user = ucfirst($db_username);
        $db_avatar = $user_row["avatar"];
        $db_birthday = $birthdate = date("F d, Y", strtotime($user_row["birthday"]));
        $db_gender = $user_row["gender"];

        if ($db_last_login == "") {
            header("Location: ./change-password");
        }
    } else {

        header("Location: ../../capstone-new");
        die();
    } ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="app" v-loading.fullscreen.lock="fullscreenLoading">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column vh-100">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include("./import/nav.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- ElementUI Container -->
                    <?php include("./user-profile.php"); ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php include("./import/footer.php") ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php include("./import/body.php") ?>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#app",
            data() {
                return {
                    fullscreenLoading: true,
                    backToHome: false,
                    fileImg: null,
                    fileUrl: null,
                    avatar: "",
                    error: true,
                    loadButton: false,
                    checkPass: false,
                    currentPassword: "",
                    newPassword: "",
                    confirmPassword: "",
                    currentPassErr: "",
                    newPassErr: "",
                    confirmPassErr: "",
                    errors: true,
                }
            },
            created() {
                this.fetchAvatar()
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
                if (window.location.pathname != "/caps/capstone-new/bhw/") {
                    localStorage.clear()
                    this.backToHome = true;
                }
            },
            methods: {
                // Logout **********************************************************
                logout() {
                    this.fullscreenLoading = true
                    axios.post("../auth.php?action=logout")
                        .then(response => {
                            if (response.data.message) {
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged out!',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = "../../capstone-new"
                                }, 1000)
                            }
                        })
                },
                // ******************************************************************
                fetchAvatar() {
                    const fetchAvatar = new FormData();
                    fetchAvatar.append("id", <?php echo $id; ?>)
                    axios.post("action.php?action=fetch_avatar", fetchAvatar)
                        .then(response => {
                            if (response) {
                                this.avatar = "../assets/" + response.data
                            }
                        })
                },
                fileUpload() {
                    if (this.$refs.file.files.length > 0) {
                        if (this.$refs.file.files[0].type != "image/jpeg") {
                            this.$message.error("Avatar image must be in JPG format!");
                            this.fileImg = null;
                            this.error = true;
                            this.$refs.file.value = null;
                        } else {
                            this.error = false;
                        }
                    }

                    if (this.$refs.file.files.length > 0) {
                        if (this.$refs.file.files[0].size > 2000000) {
                            this.$message.error("Avatar image size can not exceed 2MB!");
                            this.fileImg = null;
                            this.error = true;
                            this.$refs.file.value = null;
                        } else {
                            this.error = false;
                        }
                    }

                    if (!this.error) {
                        this.fileImg = this.$refs.file.files[0];
                        const reader = new FileReader();
                        reader.readAsDataURL(this.fileImg);
                        reader.onload = (e) => {
                            this.fileUrl = e.target.result;
                        };
                    }
                },
                submitFile() {
                    this.loadButton = true;
                    const newAvatar = new FormData();
                    newAvatar.append("id", <?php echo $id; ?>)
                    newAvatar.append("file", this.fileImg)
                    axios.post("action.php?action=update_avatar", newAvatar)
                        .then(res => {
                            if (res) {
                                setTimeout(() => {
                                    this.fetchAvatar();
                                    this.loadButton = false;
                                    this.fileImg = null;
                                    this.$message({
                                        message: 'Profile image has been updated!',
                                        type: 'success'
                                    });
                                }, 500)
                            }
                        })
                },
                removeAvatar() {
                    this.fileImg = null;
                    this.fileUrl = null;
                },
                checkPassword() {
                    this.currentPassErr = ""
                    if (!this.currentPassword) {
                        this.currentPassErr = "Current password is required!"
                    } else {
                        const checkPassword = new FormData();
                        checkPassword.append("id", <?php echo $id; ?>)
                        checkPassword.append("currentPassword", this.currentPassword)
                        axios.post("action.php?action=check_password", checkPassword)
                            .then(res => {
                                if (res) {
                                    if (res.data.error) {
                                        this.currentPassErr = res.data.message;
                                    } else {
                                        this.checkPass = true;
                                    }
                                }
                            })
                    }
                },
                updatePassword() {
                    this.newPassErr = ""
                    this.confirmPassErr = ""
                    if (!this.newPassword) {
                        this.newPassErr = "New password is required!"
                    } else {
                        if (this.newPassword.length < 8) {
                            this.newPassErr = "Password should atleast eight(8) characters!"
                        }

                        if (this.newPassword == this.currentPassword) {
                            this.newPassErr = "You have entered your current password!";
                        }

                    }

                    if (!this.confirmPassword) {
                        this.confirmPassErr = "Confirm password is required!"
                    }

                    if (this.newPassword && this.confirmPassword) {

                        if (this.newPassword.length < 8) {
                            this.newPassErr = "Password should atleast eight(8) characters!";
                            this.errors = true;
                        } else {
                            this.errors = false;
                        }
                        if (this.newPassword != this.confirmPassword) {
                            this.confirmPassErr = "Password does not match!";
                            this.errors = true;
                        } else {
                            this.errors = false;
                        }

                        if (this.newPassword == this.currentPassword) {
                            this.newPassErr = "You have entered your current password!";
                            this.errors = true;
                        } else {

                        }
                    }

                    if (!this.errors) {
                        this.loadButton = true;
                        const newPassword = new FormData();
                        newPassword.append("id", <?php echo $id; ?>)
                        newPassword.append("newPassword", this.newPassword)
                        axios.post("action.php?action=update_password", newPassword)
                            .then(res => {
                                if (res) {
                                    setTimeout(() => {
                                        this.$message({
                                            message: 'Password has been updated successfully!',
                                            type: 'success'
                                        });
                                        this.currentPassword = ""
                                        this.newPassword = ""
                                        this.confirmPassword = ""
                                        this.checkPass = false;
                                        this.loadButton = false;
                                    }, 500)
                                }
                            })
                    }
                },
                resetPassword() {
                    this.newPassword = ""
                    this.confirmPassword = ""
                },
            }
        })
    </script>
</body>

</html>