<h1><?php echo htmlspecialchars($title); ?></h1>
<div class="filter-container">
    <!-- Filter Row -->
    <div class="filter-row">
        <!-- Search Bar -->
        <div class="filter-group">
            <label for="titleSearch">Search Title</label>
            <input 
                type="text" 
                id="titleSearch" 
                placeholder="Search..."
                style="padding: 10px 12px; height: 38px;"
            >
        </div>
        
        <!-- Strand Dropdown -->
        <div class="filter-group">
            <label for="strandFilter">Strand</label>
            <select id="strandFilter" style="padding: 10px 12px; height: 38px;">  <!-- Increased padding and fixed height -->
                <option value="">All Strands</option>
                <?php
                $sqlStrands = "SELECT DISTINCT strand FROM tbllesson WHERE Category='Docs'";
                $mydb->setQuery($sqlStrands);
                $strands = $mydb->loadResultList();
                foreach ($strands as $strand) {
                    echo '<option value="' . htmlspecialchars($strand->strand) . '">' . htmlspecialchars($strand->strand) . '</option>';
                }
                ?>
            </select>
        </div>
        
        <!-- Grade Dropdown -->
        <div class="filter-group">
            <label for="gradeFilter">Grade Level</label>
            <select id="gradeFilter" style="padding: 10px 12px; height: 38px;">  <!-- Increased padding and fixed height -->
                <option value="">All Grades</option>
                <?php
                $sqlGrades = "SELECT DISTINCT LessonChapter FROM tbllesson WHERE Category='Docs'";
                $mydb->setQuery($sqlGrades);
                $grades = $mydb->loadResultList();
                foreach ($grades as $grade) {
                    echo '<option value="' . htmlspecialchars($grade->LessonChapter) . '">' . htmlspecialchars($grade->LessonChapter) . '</option>';
                }
                ?>
            </select>
        </div>
        

    </div>

    <!-- Table -->
    <div class="table-container">
        <table id="example">
            <thead>
                <tr>
                    <th width="15%">Grade Level</th>
                    <th width="10%">Strand</th>
                    <th>Title</th>
                    <th width="2%">Action</th>
                </tr>
            </thead>
            <tbody id="lessonTableBody">
                <?php
                $sql = "SELECT * FROM tbllesson WHERE Category='Docs'";
                $mydb->setQuery($sql);
                $cur = $mydb->loadResultList();
                foreach ($cur as $result) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($result->LessonChapter) . '</td>';
                    echo '<td>' . htmlspecialchars($result->strand) . '</td>';
                    echo '<td>' . htmlspecialchars($result->LessonTitle) . '</td>';
                    echo '<td><a href="index.php?q=viewpdf&id=' . $result->LessonID . '" class="view-btn">View</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<style>
/* CSS Styles */
.filter-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    font-family: Arial, sans-serif;
}

.filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: flex-end;
    margin-bottom: 20px;
}

.filter-group {
    flex: 1;
    min-width: 180px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    font-size: 14px;
    line-height: 1.5;
}

input, select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
    height: 38px;
}

button {
    padding: 10px 15px; 
    background: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px; 
    height: 38px; 
}

button:hover {
    background: #e0e0e0;
}

.table-container {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px 15px; 
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #f5f5f5;
}

.view-btn {
    padding: 8px 12px;
    background:rgb(49, 132, 165);
    color: white;
    text-decoration: none;
    border-radius: 3px;
    display: inline-block;
    font-size: 14px;
}

.view-btn:hover {
    background:rgb(225, 225, 225);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .filter-group {
        min-width: 100%;
    }
    
    input, select, button {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = {
        title: document.getElementById('titleSearch'),
        strand: document.getElementById('strandFilter'),
        grade: document.getElementById('gradeFilter'),
        reset: document.getElementById('resetFilters')
    };
    const tableBody = document.getElementById('lessonTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    function filterTable() {
        const searchTerm = filters.title.value.toLowerCase();
        const selectedStrand = filters.strand.value.toLowerCase();
        const selectedGrade = filters.grade.value.toLowerCase();

        for (let row of rows) {
            const title = row.cells[2].textContent.toLowerCase();
            const strand = row.cells[1].textContent.toLowerCase();
            const grade = row.cells[0].textContent.toLowerCase();

            const titleMatch = title.includes(searchTerm);
            const strandMatch = !selectedStrand || strand === selectedStrand;
            const gradeMatch = !selectedGrade || grade === selectedGrade;

            row.style.display = (titleMatch && strandMatch && gradeMatch) ? '' : 'none';
        }
    }

    // Event Listeners
    filters.title.addEventListener('input', filterTable);
    filters.strand.addEventListener('change', filterTable);
    filters.grade.addEventListener('change', filterTable);
    
    filters.reset.addEventListener('click', function() {
        filters.title.value = '';
        filters.strand.value = '';
        filters.grade.value = '';
        filterTable();
    });
});
</script>