CREATE TABLE assignment_results
(
  phone character varying NOT NULL,
  name character varying,
  result1 double precision,
  result2 double precision,
  result3 double precision
)

CREATE TABLE leads
(
  name character varying,
  phone character varying NOT NULL,
  CONSTRAINT leads_pkey PRIMARY KEY (phone)
)

CREATE OR REPLACE FUNCTION eval_answer(answer double precision)
  RETURNS double precision AS
$BODY$
BEGIN
return case when answer is not null then ln(1 + (1 / answer)) else 0 end;
END;
$BODY$
LANGUAGE plpgsql volatile
COST 100;

-- Получить список победителей
select act.*, eval_answer(act.result1) + eval_answer(act.result2) + eval_answer(act.result3) as total from assignment_results act
left join assignment_results tmp on act.phone = tmp.phone and eval_answer(act.result1) + eval_answer(act.result2) + eval_answer(act.result3) < eval_answer(tmp.result1) +eval_answer(tmp.result2) + eval_answer(tmp.result3)
where tmp is null
order by eval_answer(act.result1) + eval_answer(act.result2) + eval_answer(act.result3) desc;
