<?php
require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/government/democracy.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/government/election.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/government/budget.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/economy/mob.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/economy/plan.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/economy/company.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/economy/gosplan.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/economy/worker.php';
require_once $_SERVER['DOCUMENT_ROOT'] .'/local/ogas/economy/economy.php';



const   UNITS_HLID = 6; //HL инфоблок Единицы измерения
const   TYPES_HLID = 8; //HL инфоблок Типы средств
const   PERIODS_HLID = 9; //HL инфоблок Периоды времени

const   FACTORS_IBID = 27; //Инфоблок Факторы производства
const   STRUCTURE_IBID = 25; //Инфоблок Структура производства
const   SALES_IBID = 28; //Инфоблок Продажи
const   COMPANY_IBID = 20; //Инфоблок Предприятия
const   WORKERS_IBID = 24; //Инфоблок Сотрудники
const   POSITION_IBID = 23; //Инфоблок Должности
const   TARIFFGRID_IBID = 29; //Инфоблок Единая тарифная сетка
const   PRODUCTIONPLANS_IBID = 30; //Инфоблок Планы производства
const   WORKINGTIME_IBID = 31; //Инфоблок Рабочее время
const   EXPANSION_IBID = 32; //Инфоблок Расширение производства


