WITH RECURSIVE
    t AS(
        SELECT
            book_id,
            start_page,
            MAX(end_page) end_page,
            row_number() OVER(
        PARTITION BY book_id
    ORDER BY
        start_page
    ) rn
        FROM
            reading_intervals
        GROUP BY
            book_id,
            start_page),
    r AS(
        SELECT
            0 lvl,
            bu.book_id,
            bu.start_page,
            bu.end_page,
            bu.rn
        FROM
            t bu
        WHERE NOT
                  EXISTS(
            SELECT
                1
            FROM
                t bu2
            WHERE
                bu2.book_id = bu.book_id AND bu2.rn < bu.rn AND bu.start_page BETWEEN bu2.start_page AND bu2.end_page
        )
        UNION ALL
        SELECT
            lvl +1,
            r.book_id,
            r.start_page,
            t.end_page,
            t.rn
        FROM
            r
                INNER JOIN t ON t.book_id = r.book_id AND t.rn > r.rn AND r.end_page BETWEEN t.start_page AND r.end_page
    )
SELECT
    book_id,
    CAST(SUM(end_page - start_page + 1) AS UNSIGNED) num_of_read_pages
FROM
    (
        SELECT
            book_id,
            start_page,
            MAX(end_page) end_page
        FROM
            r
        GROUP BY
            book_id,
            start_page
    ) gr
GROUP BY
    book_id;
