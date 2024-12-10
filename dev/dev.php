<div class="devPanel">
    <button class="devButton" onclick="applyOutline()">OL</button>
</div>

<script>

let outlineApplied = false;

function applyOutline() {
    if (outlineApplied) {
        document.querySelectorAll('*').forEach(element => {
            element.style.outline = '';
        });
        outlineApplied = false;
    } else {
        document.querySelectorAll('*').forEach(element => {
            element.style.outline = '1px solid black';
        });
        outlineApplied = true;
    }
}

</script>