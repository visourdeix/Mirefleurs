function linkFormatter(value, row) {
    return '<a href="' + row.link + '">' + value + "</a>";
}

function positionFormatter(value, row) {
    return row.position;
}

function backgroundRowStyle(row) {
    if (row.background !== "")
        return {
            css: { "background-color": row.background }
        };

    return {};
}