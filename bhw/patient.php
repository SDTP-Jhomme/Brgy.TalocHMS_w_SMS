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
            <div v-else-if="searchValue == 'phone_number'">
                <el-input v-model="searchContact" size="mini" placeholder="Type to search..." clearable />
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
    <el-table-column sortable label="Date Visited" prop="date">
    </el-table-column>
    <el-table-column sortable label="Name" width="220" prop="name">
    </el-table-column>
    <el-table-column sortable label="Phone No." prop="phone_number">
    </el-table-column>
    <el-table-column sortable label="Gender" prop="gender" width="110" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
        <template slot-scope="scope">
            <el-tag size="small" v-if="scope.row.gender == 'Male'">{{ scope.row.gender }}</el-tag>
            <el-tag size="small" v-else type="danger">{{ scope.row.gender }}</el-tag>
        </template>
    </el-table-column>
    <el-table-column label="Actions" width="150">
        <template slot-scope="scope">
            <el-tooltip class="item" effect="dark" content="Send Message" placement="top-start">
                <el-button icon="el-icon-position" size="mini" type="success" @click="handleView(scope.$index, scope.row)">Select</el-button>
            </el-tooltip>
        </template>
    </el-table-column>
</el-table>
<div class="d-flex justify-content-between mt-2">
    <el-checkbox v-model="showAllData">Show All</el-checkbox>
    <el-pagination :current-page.sync="page" :pager-count="5" :page-size="this.pageSize" background layout="prev, pager, next" :total="this.tableData.length" @current-change="setPage">
    </el-pagination>
</div>