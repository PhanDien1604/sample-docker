--Cau 1
SELECT categories.*, count(items.id) as count_items 
FROM categories 
LEFT JOIN items on categories.id = items.category_id
GROUP BY categories.id;

--Cau 2
SELECT categories.*, sum(items.amount) as sum_items_amount 
FROM categories 
LEFT JOIN items on categories.id = items.category_id
GROUP BY categories.id;

--Cau 3
SELECT categories.*, items.amount FROM categories 
INNER JOIN (SELECT * FROM items WHERE amount > 40) AS items
ON categories.id = items.category_id
GROUP BY categories.id;

--Cau 4
DELETE FROM categories WHERE id NOT IN 
(
    SELECT DISTINCT category_id FROM items
    WHERE category_id IS NOT NULL
);


