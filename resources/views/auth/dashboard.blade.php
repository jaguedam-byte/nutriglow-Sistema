<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel</title>
    <link rel="stylesheet" href="{{ asset('css/panel-admin.css') }}">
    <style>
        body.dashboard-page{
            background:
                radial-gradient(circle at top right, rgba(62, 117, 255, 0.18), transparent 24%),
                radial-gradient(circle at top left, rgba(21, 199, 185, 0.16), transparent 22%),
                linear-gradient(135deg, #06070b 0%, #0c1020 45%, #12182a 100%);
            color: #eef3ff;
        }

        .dashboard-page .main-content{
            background: transparent;
        }

        .dashboard-page .topbar{
            background: rgba(7, 10, 18, 0.78);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px);
        }

        .dashboard-page .sidebar{
            background: linear-gradient(180deg, rgba(15, 19, 30, 0.97) 0%, rgba(11, 15, 24, 0.96) 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
        }

        .dashboard-page .brand{
            background: rgba(255, 255, 255, 0.03);
        }

        .dashboard-page .profile-box{
            background: rgba(255, 255, 255, 0.03);
        }

        .dashboard-page .search-box{
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
        }

        .dashboard-page .menu-item{
            border-left: none;
            border-radius: 14px;
            margin: 0 10px 6px;
        }

        .dashboard-page .menu-item:hover,
        .dashboard-page .menu-item.active{
            background: rgba(122, 103, 255, 0.16);
            box-shadow: inset 0 0 0 1px rgba(110, 164, 255, 0.18);
        }

        .dashboard-shell{
            padding: 28px;
        }

        .dashboard-hero{
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            padding: 34px;
            background:
                radial-gradient(circle at 20% 20%, rgba(153, 119, 255, 0.32), transparent 28%),
                radial-gradient(circle at 85% 10%, rgba(50, 212, 255, 0.24), transparent 25%),
                linear-gradient(135deg, rgba(12, 15, 28, 0.96), rgba(18, 26, 55, 0.96));
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.35);
            margin-bottom: 24px;
        }

        .dashboard-hero::after{
            content: "";
            position: absolute;
            inset: auto -40px -60px auto;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 74, 126, 0.28), transparent 65%);
        }

        .dashboard-label{
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #d4def5;
            font-size: 13px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .dashboard-hero h1{
            font-size: 52px;
            line-height: 1;
            margin-bottom: 14px;
            letter-spacing: -0.04em;
        }

        .dashboard-hero p{
            max-width: 720px;
            color: #d2dbf5;
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 26px;
        }

        .dashboard-meta{
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .dashboard-meta-card{
            padding: 18px 20px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .dashboard-meta-card span{
            display: block;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #96a7d7;
            margin-bottom: 8px;
        }

        .dashboard-meta-card strong{
            color: #ffffff;
            font-size: 18px;
        }

        .modules-panel{
            border-radius: 26px;
            overflow: hidden;
            background: rgba(10, 13, 22, 0.84);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 26px 60px rgba(0, 0, 0, 0.28);
            backdrop-filter: blur(10px);
        }

        .modules-panel-header{
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            padding: 24px 28px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .modules-panel-header h2{
            font-size: 32px;
            margin-bottom: 8px;
        }

        .modules-panel-header p{
            color: #b8c4e1;
            font-size: 15px;
        }

        .modules-panel-badge{
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(72, 223, 196, 0.12);
            color: #62ead1;
            font-weight: bold;
            font-size: 13px;
            white-space: nowrap;
        }

        .modules-grid{
            padding: 24px 28px 30px;
            display: grid;
            gap: 16px;
        }

        .module-card{
            display: grid;
            grid-template-columns: 72px minmax(0, 1.6fr) minmax(160px, 0.8fr) 140px;
            gap: 18px;
            align-items: center;
            padding: 20px 22px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
        }

        .module-card:hover{
            transform: translateY(-2px);
            border-color: rgba(122, 103, 255, 0.26);
            background: rgba(255, 255, 255, 0.05);
        }

        .module-icon{
            width: 56px;
            height: 56px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            background: linear-gradient(135deg, rgba(126, 99, 255, 0.3), rgba(35, 208, 255, 0.18));
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.08);
        }

        .module-copy h3{
            font-size: 24px;
            margin-bottom: 6px;
        }

        .module-copy p{
            color: #b7c2df;
            line-height: 1.6;
        }

        .module-status{
            justify-self: start;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            font-weight: bold;
            font-size: 14px;
        }

        .module-status::before{
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .module-status-ready{
            color: #66f2d8;
            background: rgba(52, 223, 192, 0.12);
        }

        .module-status-ready::before{
            background: #27d8b7;
        }

        .module-status-pending{
            color: #ffce72;
            background: rgba(255, 188, 62, 0.12);
        }

        .module-status-pending::before{
            background: #f0aa22;
        }

        .module-action{
            justify-self: end;
        }

        .module-button{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 118px;
            padding: 13px 18px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .module-button-primary{
            background: linear-gradient(135deg, #2c5d93, #264870);
            color: #eff6ff;
            box-shadow: 0 10px 24px rgba(29, 73, 117, 0.28);
        }

        .module-button-muted{
            background: rgba(255, 255, 255, 0.03);
            color: #9eadc9;
        }

        .panel-section{
            display: none;
        }

        .panel-section.is-active{
            display: block;
        }

        .single-tab-overlay{
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: #101b20;
        }

        .single-tab-overlay.is-visible{
            display: flex;
        }

        .single-tab-card{
            width: min(620px, 100%);
            border-radius: 20px;
            padding: 30px;
            background: #1d1f1f;
            color: #ffffff;
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.42);
        }

        .single-tab-card p{
            margin: 0;
            font-size: 1rem;
            line-height: 1.45;
            font-weight: 700;
        }

        .single-tab-actions{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 18px;
            margin-top: 44px;
        }

        .single-tab-close,
        .single-tab-use{
            border: 0;
            font-weight: 800;
            cursor: pointer;
        }

        .single-tab-close{
            background: transparent;
            color: #21c86b;
            padding: 12px 8px;
        }

        .single-tab-use{
            border-radius: 999px;
            background: #21c765;
            color: #06110b;
            padding: 14px 30px;
        }

        .workspace-shell{
            border-radius: 26px;
            overflow: hidden;
            background: rgba(229, 235, 245, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 26px 60px rgba(0, 0, 0, 0.24);
        }

        .workspace-topbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            padding: 18px 24px;
            background: rgba(255,255,255,0.8);
            border-bottom: 1px solid rgba(134, 152, 183, 0.18);
        }

        .workspace-search{
            flex: 1;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 18px;
            background: white;
            border: 1px solid rgba(152, 171, 197, 0.28);
        }

        .workspace-search span{
            color: #7d8fae;
            font-size: 20px;
        }

        .workspace-search input{
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            font-size: 16px;
            color: #48607f;
        }

        .workspace-search button{
            border: none;
            background: #1da7ff;
            color: white;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .workspace-user{
            display: flex;
            align-items: center;
            gap: 12px;
            color: #4f6483;
            font-weight: bold;
        }

        .workspace-user img{
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .workspace-body{
            padding: 24px;
            color: #50627f;
        }

        .workspace-stats{
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 26px;
        }

        .workspace-stat{
            background: white;
            border-radius: 22px;
            border: 1px solid rgba(152, 171, 197, 0.2);
            box-shadow: 0 14px 30px rgba(98, 121, 155, 0.12);
            padding: 24px 26px;
        }

        .workspace-stat-top{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .workspace-stat h3{
            font-size: 18px;
            color: #536b8e;
        }

        .workspace-stat small{
            color: #91a2bb;
            font-weight: bold;
        }

        .workspace-stat-value{
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .workspace-stat-icon{
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: white;
            background: linear-gradient(135deg, #17a5ff, #2888ec);
        }

        .workspace-stat-number{
            font-size: 56px;
            color: #5d7395;
            line-height: 1;
        }

        .workspace-progress{
            height: 18px;
            border-radius: 999px;
            background: #dce4ef;
            overflow: hidden;
            margin-top: 18px;
        }

        .workspace-progress span{
            display: block;
            height: 100%;
            width: 72%;
            border-radius: inherit;
            background: linear-gradient(90deg, #28c65e, #34d06c);
        }

        .workspace-heading{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .workspace-heading h2{
            font-size: 34px;
            color: #5a6f90;
        }

        .workspace-heading button{
            border: none;
            background: #17a5ff;
            color: white;
            padding: 14px 22px;
            border-radius: 14px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .workspace-table-shell{
            background: white;
            border-radius: 24px;
            border: 1px solid rgba(152, 171, 197, 0.2);
            box-shadow: 0 14px 30px rgba(98, 121, 155, 0.12);
            overflow: hidden;
        }

        .workspace-table-toolbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            padding: 18px 22px;
            border-bottom: 1px solid #e6edf5;
        }

        .workspace-table-search{
            width: min(100%, 380px);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 999px;
            background: #f4f7fb;
            border: 1px solid #dce6f2;
        }

        .workspace-table-search input{
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            color: #5c7394;
            font-size: 16px;
        }

        .workspace-table{
            width: 100%;
            border-collapse: collapse;
            min-width: 760px;
        }

        .workspace-table th{
            padding: 16px 22px;
            text-align: left;
            font-size: 14px;
            color: #92a2b9;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            background: #f8fbff;
        }

        .workspace-table td{
            padding: 18px 22px;
            border-top: 1px solid #edf2f8;
            color: #617896;
        }

        .workspace-user-chip{
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .workspace-avatar{
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8fd3ff, #56a6ff);
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .workspace-state{
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #23bb61;
            font-weight: bold;
        }

        .workspace-state::before{
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #23bb61;
        }

        .workspace-actions{
            display: flex;
            gap: 10px;
        }

        .workspace-action{
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid #d7e1ec;
            background: #f8fbff;
            color: #7288a7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .workspace-actions > .workspace-action{
            display: none;
        }

        .workspace-action-button{
            min-width: 92px;
            height: 38px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid rgba(39, 65, 96, 0.9);
            background: rgba(13, 23, 33, 0.72);
            color: #b8c7dc;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: transform 0.18s ease, border-color 0.18s ease, background 0.18s ease, color 0.18s ease;
        }

        .workspace-action-button:hover{
            transform: translateY(-1px);
            border-color: rgba(29, 167, 255, 0.65);
            color: #e6f5ff;
        }

        .workspace-action-button.action-edit{
            background: rgba(29, 167, 255, 0.12);
            color: #a9dcff;
        }

        .workspace-action-button.action-delete{
            background: rgba(255, 92, 131, 0.12);
            color: #ffc0ce;
        }

        .agenda-status-button{
            width: 18px;
            height: 18px;
            border-radius: 999px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 2px rgba(255,255,255,0.06);
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }

        .agenda-status-button:hover{
            transform: scale(1.08);
            box-shadow: 0 0 0 2px rgba(255,255,255,0.12);
        }

        .agenda-status-button.is-pending{
            background: #d74f68;
        }

        .agenda-status-button.is-upcoming{
            background: #23bb61;
        }

        .agenda-status-button.is-completed{
            background: #d74f68;
        }

        .reschedule-week-shell{
            overflow: auto;
            border-radius: 18px;
            border: 1px solid rgba(135, 168, 203, 0.14);
            background: rgba(13, 20, 31, 0.48);
        }

        .reschedule-week-grid{
            display: grid;
            grid-template-columns: 84px repeat(7, minmax(150px, 1fr));
            min-width: 1180px;
        }

        .reschedule-week-head{
            position: sticky;
            top: 0;
            z-index: 1;
            background: rgba(13, 20, 31, 0.96);
            color: #8aa0be;
            font-weight: 800;
            padding: 14px 12px;
            border-bottom: 1px solid rgba(135, 168, 203, 0.14);
            text-align: center;
        }

        .reschedule-week-head.time{
            text-align: right;
            padding-right: 16px;
        }

        .reschedule-time-slot{
            min-height: 72px;
            padding: 12px 14px;
            border-right: 1px solid rgba(135, 168, 203, 0.1);
            border-bottom: 1px solid rgba(135, 168, 203, 0.1);
            color: #8aa0be;
            font-weight: 700;
            text-align: right;
            background: rgba(10, 16, 26, 0.48);
        }

        .reschedule-day-cell{
            min-height: 72px;
            padding: 10px;
            border-right: 1px solid rgba(135, 168, 203, 0.1);
            border-bottom: 1px solid rgba(135, 168, 203, 0.1);
            background: rgba(12, 18, 28, 0.36);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .reschedule-appointment-link{
            display: block;
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 14px;
            border: 1px solid rgba(23,165,255,0.22);
            background: rgba(23,165,255,0.1);
            color: #dff4ff;
            transition: transform 0.16s ease, border-color 0.16s ease, background 0.16s ease;
        }

        .reschedule-appointment-link:hover{
            transform: translateY(-1px);
            border-color: rgba(23,165,255,0.42);
            background: rgba(23,165,255,0.16);
        }

        .reschedule-appointment-link.is-upcoming{
            border-color: rgba(35, 187, 97, 0.48);
            background: rgba(35, 187, 97, 0.13);
        }

        .reschedule-appointment-link.is-due{
            border-color: rgba(215, 79, 104, 0.5);
            background: rgba(215, 79, 104, 0.14);
        }

        .reschedule-appointment-link.is-completed{
            border-color: rgba(215, 79, 104, 0.55);
            background: rgba(215, 79, 104, 0.16);
        }

        .reschedule-appointment-link.is-active{
            border-color: rgba(77, 230, 179, 0.65);
            background: rgba(77, 230, 179, 0.16);
            box-shadow: 0 0 0 1px rgba(77, 230, 179, 0.18);
        }

        .reschedule-appointment-time{
            display: block;
            font-size: 0.78rem;
            color: #8fc4ff;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .reschedule-appointment-name{
            display: block;
            font-weight: 800;
            color: #f4fbff;
            line-height: 1.25;
        }

        .reschedule-appointment-mail{
            display: block;
            margin-top: 4px;
            font-size: 0.8rem;
            color: #8aa0be;
            line-height: 1.25;
            word-break: break-word;
        }

        .floating-toast{
            position: fixed;
            right: 28px;
            bottom: 28px;
            z-index: 50;
            min-width: 280px;
            max-width: min(420px, calc(100vw - 48px));
            padding: 16px 18px;
            border-radius: 18px;
            border: 1px solid rgba(52, 223, 192, 0.22);
            background: rgba(9, 16, 25, 0.94);
            color: #dffef8;
            box-shadow: 0 22px 55px rgba(0, 0, 0, 0.38);
            opacity: 0;
            transform: translateY(18px);
            pointer-events: none;
            transition: opacity 0.22s ease, transform 0.22s ease;
            backdrop-filter: blur(14px);
            font-weight: 800;
        }

        .floating-toast.is-visible{
            opacity: 1;
            transform: translateY(0);
        }

        .confirm-overlay{
            position: fixed;
            inset: 0;
            z-index: 60;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(4, 7, 12, 0.62);
            backdrop-filter: blur(10px);
        }

        .confirm-overlay.is-visible{
            display: flex;
        }

        .confirm-card{
            width: min(420px, 100%);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: linear-gradient(145deg, rgba(13, 22, 34, 0.98), rgba(7, 12, 20, 0.98));
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.48);
            padding: 26px;
            color: #e8f2ff;
        }

        .confirm-card h3{
            margin: 0 0 10px;
            font-size: 24px;
        }

        .confirm-card p{
            margin: 0;
            color: #9fb1ca;
            line-height: 1.6;
        }

        .confirm-actions{
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .confirm-actions button{
            border: none;
            border-radius: 999px;
            padding: 12px 18px;
            font-weight: 800;
            cursor: pointer;
        }

        .confirm-cancel{
            background: rgba(255, 255, 255, 0.08);
            color: #c6d5e9;
        }

        .confirm-delete{
            background: linear-gradient(135deg, #ff5c83, #d93664);
            color: white;
        }

        .password-hints{
            grid-column: 1 / -1;
            display: grid;
            gap: 6px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(39, 65, 96, 0.9);
            color: #9fb1ca;
            font-size: 13px;
        }

        .password-hints span.is-valid{
            color: #72f0c8;
        }

        .password-field{
            position: relative;
        }

        .password-check{
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            color: #5a6f90;
            font-weight: 700;
            cursor: pointer;
            user-select: none;
        }

        .password-check input{
            width: 18px;
            height: 18px;
            accent-color: #17a5ff;
        }

        .admin-reset-box{
            grid-column: 1 / -1;
            display: none;
            gap: 14px;
            padding: 18px;
            border-radius: 18px;
            border: 1px solid rgba(39, 65, 96, 0.9);
            background: rgba(14, 23, 36, 0.38);
        }

        .admin-reset-box.is-visible{
            display: grid;
        }

        .admin-reset-row{
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 12px;
            align-items: end;
        }

        .admin-reset-help{
            margin: 0;
            color: #8ea5c4;
            font-size: 13px;
            line-height: 1.5;
        }

        .workspace-user-trigger{
            border: none;
            background: transparent;
            padding: 0;
            cursor: pointer;
            text-align: left;
            color: inherit;
        }

        .workspace-detail{
            display: none;
            margin-top: 22px;
            background: white;
            border-radius: 24px;
            border: 1px solid rgba(152, 171, 197, 0.2);
            box-shadow: 0 14px 30px rgba(98, 121, 155, 0.12);
            overflow: hidden;
        }

        .workspace-detail.is-visible{
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
        }

        .workspace-detail-info,
        .workspace-detail-image{
            padding: 24px;
        }

        .workspace-detail-info{
            border-right: 1px solid #edf2f8;
        }

        .workspace-detail-info h3,
        .workspace-detail-image h3{
            font-size: 24px;
            color: #5a6f90;
            margin-bottom: 18px;
        }

        .workspace-detail-list{
            display: grid;
            gap: 14px;
        }

        .workspace-detail-item span{
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #91a2bb;
            margin-bottom: 6px;
        }

        .workspace-detail-item strong{
            color: #556b8d;
            font-size: 18px;
        }

        .workspace-image-placeholder{
            min-height: 240px;
            border-radius: 18px;
            border: 2px dashed #d8e2ee;
            background: linear-gradient(135deg, #f9fbff, #eef3fa);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a7bf;
            font-weight: bold;
        }

        .history-layout{
            display: grid;
            grid-template-columns: 320px minmax(0, 1fr);
            gap: 22px;
        }

        .history-users-panel,
        .history-records-panel{
            background: white;
            border-radius: 24px;
            border: 1px solid rgba(152, 171, 197, 0.2);
            box-shadow: 0 14px 30px rgba(98, 121, 155, 0.12);
            overflow: hidden;
        }

        .history-users-toolbar{
            padding: 18px;
            border-bottom: 1px solid #e6edf5;
        }

        .history-users-search{
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 16px;
            background: #f8fbff;
            border: 1px solid #dce6f2;
        }

        .history-users-search span{
            color: #91a2bb;
        }

        .history-users-search input{
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            color: #58708f;
            font-size: 15px;
        }

        .history-user-list{
            display: grid;
            gap: 10px;
            padding: 18px;
        }

        .history-user-link{
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 18px;
            text-decoration: none;
            color: #5f7496;
            border: 1px solid #e5edf6;
            transition: border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .history-user-link:hover,
        .history-user-link.is-active{
            border-color: rgba(23, 165, 255, 0.28);
            box-shadow: 0 12px 24px rgba(33, 91, 158, 0.1);
            transform: translateY(-1px);
        }

        .history-user-meta{
            display: grid;
            gap: 4px;
        }

        .history-user-meta strong{
            color: #4f6483;
        }

        .history-user-meta span{
            color: #91a2bb;
            font-size: 13px;
        }

        .history-user-list.is-filtering .history-user-link{
            display: none;
        }

        .history-user-list.is-filtering .history-user-link.is-match{
            display: flex;
        }

        .history-toolbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 20px 22px;
            border-bottom: 1px solid #e6edf5;
            flex-wrap: wrap;
        }

        .history-toolbar h3{
            font-size: 28px;
            color: #5a6f90;
            margin-bottom: 4px;
        }

        .history-toolbar p{
            color: #91a2bb;
        }

        .history-filters{
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .history-filter-group{
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .history-filter-button{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            border-radius: 999px;
            text-decoration: none;
            background: #f4f7fb;
            border: 1px solid #dce6f2;
            color: #607695;
            font-weight: bold;
        }

        .history-filter-button.is-active{
            background: #17a5ff;
            border-color: #17a5ff;
            color: white;
            box-shadow: 0 12px 24px rgba(23, 165, 255, 0.22);
        }

        .history-date-form{
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .history-date-form input{
            min-width: 160px;
            padding: 11px 14px;
            border-radius: 12px;
            border: 1px solid #dce6f2;
            background: #f8fbff;
            color: #58708f;
            outline: none;
        }

        .history-date-form button,
        .history-date-clear{
            border: none;
            padding: 11px 16px;
            border-radius: 12px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .history-date-form button{
            background: #17a5ff;
            color: white;
        }

        .history-date-clear{
            background: #edf3fa;
            color: #607695;
        }

        .history-days-shell{
            padding: 22px;
        }

        .history-days-shell.is-hidden{
            display: none;
        }

        .history-days-table{
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e6edf5;
            border-radius: 18px;
            overflow: hidden;
        }

        .history-days-table th{
            padding: 14px 18px;
            background: #f8fbff;
            color: #92a2b9;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-size: 13px;
            text-align: left;
        }

        .history-days-table td{
            padding: 14px 18px;
            border-top: 1px solid #edf2f8;
            color: #617896;
            font-size: 15px;
        }

        .history-day-button{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            border: none;
            background: transparent;
            color: inherit;
            cursor: pointer;
            padding: 0;
            text-align: left;
            font: inherit;
        }

        .history-day-button strong{
            color: #556b8d;
        }

        .history-day-button.is-active strong,
        .history-day-button:hover strong{
            color: #17a5ff;
        }

        .history-day-badge{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 92px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #f4f8fd;
            color: #7288a7;
            font-weight: bold;
            font-size: 13px;
        }

        .history-day-detail{
            display: none;
            margin: 0 22px 22px;
            border: 1px solid #e5edf6;
            border-radius: 24px;
            overflow: hidden;
            background: #fff;
        }

        .history-day-detail.is-visible{
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) 260px;
        }

        .history-back-button{
            border: none;
            background: #edf3fa;
            color: #607695;
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .history-day-detail-info,
        .history-day-detail-image{
            padding: 22px;
        }

        .history-day-detail-info{
            border-right: 1px solid #edf2f8;
        }

        .history-day-detail-top{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .history-day-detail-top h4,
        .history-day-detail-image h4{
            font-size: 22px;
            color: #566d8f;
        }

        .history-day-detail-date{
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 999px;
            background: #f4f8fd;
            color: #7288a7;
            font-weight: bold;
        }

        .history-day-detail-grid{
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .history-day-detail-item{
            padding: 14px 16px;
            border-radius: 16px;
            background: #f8fbff;
            border: 1px solid #e6edf5;
        }

        .history-day-detail-item span{
            display: block;
            margin-bottom: 6px;
            color: #91a2bb;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .history-day-detail-item strong{
            color: #59708f;
            font-size: 16px;
        }

        .history-empty{
            padding: 28px 22px 34px;
            color: #91a2bb;
            text-align: center;
        }

        .recipe-range-badge,
        .recipe-range-select{
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 86px;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .recipe-range-form{
            margin: 0;
        }

        .recipe-range-select{
            border: 1px solid transparent;
            cursor: pointer;
            outline: none;
            text-align: center;
        }

        .recipe-range-select:focus{
            border-color: rgba(0, 132, 209, 0.55);
            box-shadow: 0 0 0 3px rgba(0, 132, 209, 0.12);
        }

        .recipe-range-select.recipe-range-alto{
            color: #ffd6d6;
        }

        .recipe-range-select.recipe-range-medio{
            color: #ffe6a8;
        }

        .recipe-range-select.recipe-range-bajo{
            color: #bffff2;
        }

        .recipe-range-alto{
            color: #ff8a8a;
            background: rgba(255, 92, 92, 0.12);
        }

        .recipe-range-medio{
            color: #ffce72;
            background: rgba(255, 188, 62, 0.14);
        }

        .recipe-range-bajo{
            color: #66f2d8;
            background: rgba(52, 223, 192, 0.12);
        }

        .recipe-user-button{
            width: 100%;
            border: none;
            background: transparent;
            color: inherit;
            text-align: left;
            cursor: pointer;
            padding: 0;
        }

        .recipe-detail{
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 22px;
            padding: 22px;
            border-top: 1px solid #e6edf5;
        }

        .recipe-form{
            display: grid;
            gap: 16px;
        }

        .recipe-field label{
            display: block;
            margin-bottom: 8px;
            color: #5a6f90;
            font-weight: bold;
        }

        .recipe-field select,
        .recipe-field textarea,
        .recipe-field input{
            width: 100%;
            padding: 13px 14px;
            border-radius: 14px;
            border: 1px solid #dce6f2;
            background: #f8fbff;
            color: #4f6483;
            outline: none;
        }

        .recipe-field textarea{
            min-height: 150px;
            resize: vertical;
        }

        .recipe-submit{
            border: none;
            background: #17a5ff;
            color: white;
            padding: 13px 20px;
            border-radius: 14px;
            font-weight: bold;
            cursor: pointer;
            justify-self: start;
        }

        .recipe-image-preview{
            min-height: 220px;
            border-radius: 18px;
            border: 2px dashed #d8e2ee;
            background: linear-gradient(135deg, #f9fbff, #eef3fa);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a7bf;
            font-weight: bold;
            overflow: hidden;
        }

        .recipe-image-preview img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .topbar-right{
            gap: 14px;
        }

        .theme-toggle{
            border: none;
            background: transparent;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #b9c9df;
            font-weight: 800;
            cursor: pointer;
            padding: 0;
        }

        .theme-toggle-track{
            position: relative;
            width: 78px;
            height: 38px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: #151a22;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.04), 0 10px 24px rgba(0, 0, 0, 0.22);
            transition: background 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease;
        }

        .theme-toggle-track::before,
        .theme-toggle-track::after{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            line-height: 1;
            pointer-events: none;
        }

        .theme-toggle-track::before{
            content: "L";
            left: 15px;
            color: #0f1724;
            opacity: 0;
        }

        .theme-toggle-track::after{
            content: "D";
            right: 15px;
            color: #dfe8f7;
            opacity: 1;
        }

        .theme-toggle-thumb{
            position: absolute;
            top: 4px;
            left: 4px;
            width: 30px;
            height: 30px;
            border-radius: 999px;
            background: #f8fafc;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.35);
            transition: transform 0.22s ease, background 0.22s ease;
        }

        .theme-toggle-text{
            white-space: nowrap;
            font-size: 13px;
        }

        .dashboard-page .logout-btn{
            background: #b91c1c !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 10px 24px rgba(185, 28, 28, 0.22);
        }

        .dashboard-page .logout-btn:hover{
            background: #991b1b !important;
        }

        .dashboard-page.light-mode{
            background:
                radial-gradient(circle at top right, rgba(23, 165, 255, 0.14), transparent 25%),
                radial-gradient(circle at top left, rgba(35, 187, 97, 0.1), transparent 24%),
                linear-gradient(135deg, #f5f8fc 0%, #ffffff 48%, #edf4fb 100%);
            color: #172033;
        }

        .dashboard-page.light-mode .topbar{
            background: rgba(255, 255, 255, 0.88);
            border-bottom: 1px solid #dde8f4;
            color: #172033;
        }

        .dashboard-page.light-mode .sidebar{
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(239, 246, 253, 0.98) 100%);
            border-right: 1px solid #dde8f4;
        }

        .dashboard-page.light-mode .brand,
        .dashboard-page.light-mode .profile-box{
            background: rgba(23, 48, 78, 0.04);
        }

        .dashboard-page.light-mode .brand-light,
        .dashboard-page.light-mode .profile-info h3,
        .dashboard-page.light-mode .topbar-left,
        .dashboard-page.light-mode .top-user span,
        .dashboard-page.light-mode .menu-item span:not(.icon){
            color: #172033;
        }

        .dashboard-page.light-mode .profile-info p,
        .dashboard-page.light-mode .menu-title,
        .dashboard-page.light-mode .workspace-user,
        .dashboard-page.light-mode .theme-toggle{
            color: #52657c;
        }

        .dashboard-page.light-mode .search-box,
        .dashboard-page.light-mode .workspace-search,
        .dashboard-page.light-mode .workspace-table-search,
        .dashboard-page.light-mode .history-users-search{
            background: #ffffff;
            border-color: #d9e5f2;
            color: #52657c;
        }

        .dashboard-page.light-mode .search-box input,
        .dashboard-page.light-mode .workspace-search input,
        .dashboard-page.light-mode .workspace-table-search input,
        .dashboard-page.light-mode .history-users-search input{
            color: #25364a;
        }

        .dashboard-page.light-mode .menu-item:hover,
        .dashboard-page.light-mode .menu-item.active{
            background: #e9f2ff;
            box-shadow: inset 0 0 0 1px #cfe1f6;
        }

        .dashboard-page.light-mode .dashboard-hero,
        .dashboard-page.light-mode .modules-panel,
        .dashboard-page.light-mode .workspace-shell{
            background: rgba(255, 255, 255, 0.92);
            border-color: #dce7f4;
            box-shadow: 0 24px 55px rgba(31, 57, 89, 0.12);
        }

        .dashboard-page.light-mode .dashboard-hero h1,
        .dashboard-page.light-mode .modules-panel-header h2,
        .dashboard-page.light-mode .module-copy h3,
        .dashboard-page.light-mode .workspace-heading h2,
        .dashboard-page.light-mode .history-toolbar h3,
        .dashboard-page.light-mode .history-day-detail-top h4,
        .dashboard-page.light-mode .history-day-detail-image h4,
        .dashboard-page.light-mode .workspace-detail-info h3,
        .dashboard-page.light-mode .workspace-detail-image h3{
            color: #1f3148;
        }

        .dashboard-page.light-mode .dashboard-hero p,
        .dashboard-page.light-mode .modules-panel-header p,
        .dashboard-page.light-mode .module-copy p,
        .dashboard-page.light-mode .workspace-body,
        .dashboard-page.light-mode .history-toolbar p,
        .dashboard-page.light-mode .confirm-card p{
            color: #52657c;
        }

        .dashboard-page.light-mode .dashboard-meta-card,
        .dashboard-page.light-mode .module-card{
            background: #f8fbff;
            border-color: #e2ebf5;
        }

        .dashboard-page.light-mode .dashboard-meta-card strong{
            color: #1f3148;
        }

        .dashboard-page.light-mode .workspace-topbar,
        .dashboard-page.light-mode .workspace-table-toolbar,
        .dashboard-page.light-mode .history-users-toolbar,
        .dashboard-page.light-mode .history-toolbar,
        .dashboard-page.light-mode .recipe-detail{
            background: rgba(255, 255, 255, 0.76);
            border-color: #dce7f4;
        }

        .dashboard-page.light-mode .workspace-stat,
        .dashboard-page.light-mode .workspace-table-shell,
        .dashboard-page.light-mode .workspace-detail,
        .dashboard-page.light-mode .history-users-panel,
        .dashboard-page.light-mode .history-records-panel,
        .dashboard-page.light-mode .history-day-detail,
        .dashboard-page.light-mode .recipe-image-preview,
        .dashboard-page.light-mode .admin-reset-box,
        .dashboard-page.light-mode .reschedule-week-shell{
            background: #ffffff;
            border-color: #dce7f4;
            box-shadow: 0 14px 32px rgba(31, 57, 89, 0.1);
        }

        .dashboard-page.light-mode .workspace-table th,
        .dashboard-page.light-mode .history-days-table th,
        .dashboard-page.light-mode .reschedule-week-head{
            background: #eef5fb;
            color: #52657c;
        }

        .dashboard-page.light-mode .workspace-table td,
        .dashboard-page.light-mode .history-days-table td{
            border-color: #dfeaf5;
            color: #35485f;
        }

        .dashboard-page.light-mode .workspace-action-button,
        .dashboard-page.light-mode .history-filter-button,
        .dashboard-page.light-mode .history-back-button,
        .dashboard-page.light-mode .history-date-clear{
            background: #f4f8fc;
            border-color: #cfe0f2;
            color: #36516d;
        }

        .dashboard-page.light-mode .workspace-action-button.action-edit{
            background: #e7f5ff;
            color: #0b76bd;
        }

        .dashboard-page.light-mode .workspace-action-button.action-delete{
            background: #fff0f3;
            color: #b91c1c;
        }

        .dashboard-page.light-mode .history-filter-button.is-active,
        .dashboard-page.light-mode .workspace-heading button,
        .dashboard-page.light-mode .workspace-search button,
        .dashboard-page.light-mode .history-date-form button,
        .dashboard-page.light-mode .recipe-submit{
            background: #0f8edb;
            color: #ffffff;
        }

        .dashboard-page.light-mode .reschedule-time-slot,
        .dashboard-page.light-mode .reschedule-day-cell{
            background: #f8fbff;
            border-color: #e0eaf5;
            color: #52657c;
        }

        .dashboard-page.light-mode .reschedule-appointment-link{
            color: #1f3148;
        }

        .dashboard-page.light-mode .reschedule-appointment-name,
        .dashboard-page.light-mode .reschedule-appointment-time{
            color: #0b76bd;
        }

        .dashboard-page.light-mode .floating-toast,
        .dashboard-page.light-mode .confirm-card{
            background: #ffffff;
            border-color: #dce7f4;
            color: #1f3148;
            box-shadow: 0 24px 60px rgba(31, 57, 89, 0.18);
        }

        .dashboard-page.light-mode .theme-toggle-track{
            background: #ecf2f8;
            border-color: #d4e0ec;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.8), 0 10px 24px rgba(31, 57, 89, 0.12);
        }

        .dashboard-page.light-mode .theme-toggle-track::before{
            opacity: 1;
        }

        .dashboard-page.light-mode .theme-toggle-track::after{
            opacity: 0;
        }

        .dashboard-page.light-mode .theme-toggle-thumb{
            transform: translateX(40px);
            background: #22262d;
        }

        .dashboard-page.light-mode .logout-btn{
            background: #dc2626 !important;
            border-color: rgba(220, 38, 38, 0.24) !important;
            box-shadow: 0 10px 24px rgba(220, 38, 38, 0.2);
        }

        .dashboard-page.light-mode .main-content,
        .dashboard-page.light-mode .table-panel,
        .dashboard-page.light-mode .table-header,
        .dashboard-page.light-mode .table-wrapper,
        .dashboard-page.light-mode .panel-card,
        .dashboard-page.light-mode .panel-card-header,
        .dashboard-page.light-mode .workspace-body,
        .dashboard-page.light-mode .workspace-table-wrap,
        .dashboard-page.light-mode .history-days-shell,
        .dashboard-page.light-mode .recipe-form,
        .dashboard-page.light-mode .billing-form,
        .dashboard-page.light-mode .audit-panel,
        .dashboard-page.light-mode .agenda-panel,
        .dashboard-page.light-mode .notification-panel{
            background: transparent !important;
            color: #26384d !important;
        }

        .dashboard-page.light-mode .workspace-shell,
        .dashboard-page.light-mode .workspace-stat,
        .dashboard-page.light-mode .workspace-table-shell,
        .dashboard-page.light-mode .workspace-detail,
        .dashboard-page.light-mode .history-users-panel,
        .dashboard-page.light-mode .history-records-panel,
        .dashboard-page.light-mode .history-day-detail,
        .dashboard-page.light-mode .history-day-detail-item,
        .dashboard-page.light-mode .history-day-badge,
        .dashboard-page.light-mode .recipe-detail,
        .dashboard-page.light-mode .recipe-field,
        .dashboard-page.light-mode .admin-reset-box,
        .dashboard-page.light-mode .password-hints,
        .dashboard-page.light-mode .reschedule-week-shell,
        .dashboard-page.light-mode .confirm-card,
        .dashboard-page.light-mode .single-tab-card,
        .dashboard-page.light-mode .panel-card{
            background: #ffffff !important;
            border-color: #d8e5f2 !important;
            color: #26384d !important;
        }

        .dashboard-page.light-mode table,
        .dashboard-page.light-mode thead,
        .dashboard-page.light-mode tbody,
        .dashboard-page.light-mode tr,
        .dashboard-page.light-mode .workspace-table,
        .dashboard-page.light-mode .history-days-table{
            background: #ffffff !important;
            color: #26384d !important;
        }

        .dashboard-page.light-mode th,
        .dashboard-page.light-mode .workspace-table th,
        .dashboard-page.light-mode .history-days-table th{
            background: #eef5fb !important;
            border-color: #d8e5f2 !important;
            color: #354b65 !important;
        }

        .dashboard-page.light-mode td,
        .dashboard-page.light-mode .workspace-table td,
        .dashboard-page.light-mode .history-days-table td{
            background: #ffffff !important;
            border-color: #d8e5f2 !important;
            color: #354b65 !important;
        }

        .dashboard-page.light-mode h1,
        .dashboard-page.light-mode h2,
        .dashboard-page.light-mode h3,
        .dashboard-page.light-mode h4,
        .dashboard-page.light-mode h5,
        .dashboard-page.light-mode h6,
        .dashboard-page.light-mode strong,
        .dashboard-page.light-mode label,
        .dashboard-page.light-mode .workspace-stat h3,
        .dashboard-page.light-mode .workspace-stat-number,
        .dashboard-page.light-mode .workspace-user-chip strong,
        .dashboard-page.light-mode .history-user-meta strong,
        .dashboard-page.light-mode .history-day-button strong,
        .dashboard-page.light-mode .history-day-detail-item strong,
        .dashboard-page.light-mode .workspace-detail-item strong,
        .dashboard-page.light-mode .panel-card-header h3{
            color: #20324a !important;
        }

        .dashboard-page.light-mode p,
        .dashboard-page.light-mode small,
        .dashboard-page.light-mode span,
        .dashboard-page.light-mode .workspace-stat small,
        .dashboard-page.light-mode .workspace-table-search span,
        .dashboard-page.light-mode .history-user-meta span,
        .dashboard-page.light-mode .history-day-detail-item span,
        .dashboard-page.light-mode .workspace-detail-item span,
        .dashboard-page.light-mode .panel-card-header p{
            color: #536a84;
        }

        .dashboard-page.light-mode .brand-strong,
        .dashboard-page.light-mode .brand-strong span{
            color: #1688e7 !important;
        }

        .dashboard-page.light-mode .brand-light{
            color: #52657c !important;
        }

        .dashboard-page.light-mode .menu-item.active span:not(.icon),
        .dashboard-page.light-mode .menu-item:hover span:not(.icon){
            color: #0f2440 !important;
        }

        .dashboard-page.light-mode input:not([type="radio"]):not([type="checkbox"]),
        .dashboard-page.light-mode textarea,
        .dashboard-page.light-mode select{
            background: #ffffff !important;
            border-color: #cad9e8 !important;
            color: #20324a !important;
        }

        .dashboard-page.light-mode input::placeholder,
        .dashboard-page.light-mode textarea::placeholder{
            color: #8798ab !important;
        }

        .dashboard-page.light-mode .workspace-search,
        .dashboard-page.light-mode .workspace-table-search,
        .dashboard-page.light-mode .history-users-search,
        .dashboard-page.light-mode .history-date-form input,
        .dashboard-page.light-mode .recipe-field input,
        .dashboard-page.light-mode .recipe-field textarea,
        .dashboard-page.light-mode .recipe-field select{
            background: #ffffff !important;
            border-color: #cad9e8 !important;
            color: #20324a !important;
        }

        .dashboard-page.light-mode .reschedule-time-slot,
        .dashboard-page.light-mode .reschedule-day-cell,
        .dashboard-page.light-mode .reschedule-week-head{
            background: #f7fbff !important;
            border-color: #dce7f4 !important;
        }

        .dashboard-page.light-mode .reschedule-appointment-link.is-upcoming{
            background: #e8fff5 !important;
            border-color: rgba(35, 187, 97, 0.36) !important;
        }

        .dashboard-page.light-mode .reschedule-appointment-link.is-due,
        .dashboard-page.light-mode .reschedule-appointment-link.is-completed{
            background: #fff1f4 !important;
            border-color: rgba(215, 79, 104, 0.36) !important;
        }

        .dashboard-page.light-mode .module-status-ready,
        .dashboard-page.light-mode .workspace-state,
        .dashboard-page.light-mode .modules-panel-badge{
            color: #087f6e !important;
        }

        .dashboard-page.light-mode .module-status-pending,
        .dashboard-page.light-mode .history-day-badge{
            color: #8a6100 !important;
        }

        .dashboard-page.light-mode .workspace-avatar,
        .dashboard-page.light-mode .module-icon{
            color: #ffffff !important;
        }

        .dashboard-page:not(.light-mode){
            background:
                radial-gradient(circle at top right, rgba(62, 117, 255, 0.18), transparent 24%),
                radial-gradient(circle at top left, rgba(21, 199, 185, 0.16), transparent 22%),
                linear-gradient(135deg, #06070b 0%, #0c1020 45%, #12182a 100%) !important;
            color: #eef3ff !important;
        }

        .dashboard-page:not(.light-mode) .main-content,
        .dashboard-page:not(.light-mode) .workspace-body,
        .dashboard-page:not(.light-mode) .table-panel,
        .dashboard-page:not(.light-mode) .table-header,
        .dashboard-page:not(.light-mode) .table-wrapper,
        .dashboard-page:not(.light-mode) .history-days-shell,
        .dashboard-page:not(.light-mode) .recipe-form,
        .dashboard-page:not(.light-mode) .billing-form,
        .dashboard-page:not(.light-mode) .audit-panel,
        .dashboard-page:not(.light-mode) .agenda-panel,
        .dashboard-page:not(.light-mode) .notification-panel{
            background: transparent !important;
            color: #d7e4f5 !important;
        }

        .dashboard-page:not(.light-mode) .topbar{
            background: rgba(7, 10, 18, 0.88) !important;
            border-bottom: 1px solid rgba(135, 168, 203, 0.12) !important;
            color: #eef3ff !important;
        }

        .dashboard-page:not(.light-mode) .workspace-shell{
            background: rgba(30, 36, 36, 0.94) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 26px 60px rgba(0, 0, 0, 0.26) !important;
        }

        .dashboard-page:not(.light-mode) .workspace-topbar,
        .dashboard-page:not(.light-mode) .workspace-table-toolbar,
        .dashboard-page:not(.light-mode) .history-users-toolbar,
        .dashboard-page:not(.light-mode) .history-toolbar,
        .dashboard-page:not(.light-mode) .recipe-detail{
            background: rgba(20, 24, 24, 0.86) !important;
            border-color: rgba(135, 168, 203, 0.16) !important;
        }

        .dashboard-page:not(.light-mode) .workspace-stat,
        .dashboard-page:not(.light-mode) .workspace-table-shell,
        .dashboard-page:not(.light-mode) .workspace-detail,
        .dashboard-page:not(.light-mode) .history-users-panel,
        .dashboard-page:not(.light-mode) .history-records-panel,
        .dashboard-page:not(.light-mode) .history-day-detail,
        .dashboard-page:not(.light-mode) .history-day-detail-item,
        .dashboard-page:not(.light-mode) .history-day-badge,
        .dashboard-page:not(.light-mode) .recipe-field,
        .dashboard-page:not(.light-mode) .admin-reset-box,
        .dashboard-page:not(.light-mode) .password-hints,
        .dashboard-page:not(.light-mode) .reschedule-week-shell,
        .dashboard-page:not(.light-mode) .panel-card{
            background: rgba(18, 22, 23, 0.94) !important;
            border-color: rgba(135, 168, 203, 0.16) !important;
            color: #d7e4f5 !important;
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.24) !important;
        }

        .dashboard-page:not(.light-mode) table,
        .dashboard-page:not(.light-mode) thead,
        .dashboard-page:not(.light-mode) tbody,
        .dashboard-page:not(.light-mode) tr,
        .dashboard-page:not(.light-mode) .workspace-table,
        .dashboard-page:not(.light-mode) .history-days-table{
            background: rgba(15, 20, 24, 0.98) !important;
            color: #d7e4f5 !important;
        }

        .dashboard-page:not(.light-mode) th,
        .dashboard-page:not(.light-mode) .workspace-table th,
        .dashboard-page:not(.light-mode) .history-days-table th{
            background: rgba(20, 25, 27, 0.98) !important;
            border-color: rgba(135, 168, 203, 0.16) !important;
            color: #c8bca8 !important;
        }

        .dashboard-page:not(.light-mode) td,
        .dashboard-page:not(.light-mode) .workspace-table td,
        .dashboard-page:not(.light-mode) .history-days-table td{
            background: rgba(14, 20, 25, 0.98) !important;
            border-color: rgba(135, 168, 203, 0.16) !important;
            color: #c8bca8 !important;
        }

        .dashboard-page:not(.light-mode) h1,
        .dashboard-page:not(.light-mode) h2,
        .dashboard-page:not(.light-mode) h3,
        .dashboard-page:not(.light-mode) h4,
        .dashboard-page:not(.light-mode) h5,
        .dashboard-page:not(.light-mode) h6,
        .dashboard-page:not(.light-mode) strong,
        .dashboard-page:not(.light-mode) label,
        .dashboard-page:not(.light-mode) .workspace-heading h2,
        .dashboard-page:not(.light-mode) .workspace-stat h3,
        .dashboard-page:not(.light-mode) .workspace-user-chip strong,
        .dashboard-page:not(.light-mode) .history-user-meta strong,
        .dashboard-page:not(.light-mode) .history-day-button strong,
        .dashboard-page:not(.light-mode) .history-day-detail-item strong,
        .dashboard-page:not(.light-mode) .workspace-detail-item strong,
        .dashboard-page:not(.light-mode) .panel-card-header h3{
            color: #c8bca8 !important;
        }

        .dashboard-page:not(.light-mode) p,
        .dashboard-page:not(.light-mode) small,
        .dashboard-page:not(.light-mode) .workspace-body,
        .dashboard-page:not(.light-mode) .workspace-stat small,
        .dashboard-page:not(.light-mode) .history-user-meta span,
        .dashboard-page:not(.light-mode) .history-day-detail-item span,
        .dashboard-page:not(.light-mode) .workspace-detail-item span,
        .dashboard-page:not(.light-mode) .panel-card-header p{
            color: #9db4cf !important;
        }

        .dashboard-page:not(.light-mode) .workspace-search,
        .dashboard-page:not(.light-mode) .workspace-table-search,
        .dashboard-page:not(.light-mode) .history-users-search,
        .dashboard-page:not(.light-mode) .search-box,
        .dashboard-page:not(.light-mode) input:not([type="radio"]):not([type="checkbox"]),
        .dashboard-page:not(.light-mode) textarea,
        .dashboard-page:not(.light-mode) select{
            background: rgba(12, 17, 22, 0.78) !important;
            border-color: rgba(39, 65, 96, 0.9) !important;
            color: #d7e4f5 !important;
        }

        .dashboard-page:not(.light-mode) input::placeholder,
        .dashboard-page:not(.light-mode) textarea::placeholder{
            color: #7f91a8 !important;
        }

        .dashboard-page:not(.light-mode) .workspace-action-button,
        .dashboard-page:not(.light-mode) .history-filter-button,
        .dashboard-page:not(.light-mode) .history-back-button,
        .dashboard-page:not(.light-mode) .history-date-clear{
            background: rgba(13, 23, 33, 0.72) !important;
            border-color: rgba(39, 65, 96, 0.9) !important;
            color: #b8c7dc !important;
        }

        .dashboard-page:not(.light-mode) .reschedule-time-slot,
        .dashboard-page:not(.light-mode) .reschedule-day-cell,
        .dashboard-page:not(.light-mode) .reschedule-week-head{
            background: rgba(12, 18, 28, 0.56) !important;
            border-color: rgba(135, 168, 203, 0.12) !important;
            color: #8aa0be !important;
        }

        .dashboard-page:not(.light-mode) .workspace-avatar,
        .dashboard-page:not(.light-mode) .module-icon{
            color: #ffffff !important;
        }

        @media (max-width: 1100px){
            .dashboard-meta{
                grid-template-columns: 1fr;
            }

            .module-card{
                grid-template-columns: 60px 1fr;
            }

            .module-status,
            .module-action{
                justify-self: start;
            }

            .workspace-stats{
                grid-template-columns: 1fr;
            }

            .history-layout,
            .history-day-detail,
            .recipe-detail{
                grid-template-columns: 1fr;
            }

            .history-day-detail-info{
                border-right: none;
                border-bottom: 1px solid #edf2f8;
            }
        }

        @media (max-width: 768px){
            .dashboard-shell{
                padding: 16px;
            }

            .dashboard-hero{
                padding: 24px 20px;
                border-radius: 24px;
            }

            .dashboard-hero h1{
                font-size: 38px;
            }

            .modules-panel-header,
            .modules-grid{
                padding-left: 18px;
                padding-right: 18px;
            }

            .modules-panel-header{
                flex-direction: column;
            }

            .workspace-topbar,
            .workspace-heading,
            .workspace-table-toolbar{
                flex-direction: column;
                align-items: stretch;
            }

            .workspace-body{
                padding: 18px;
            }
        }
    </style>
</head>
<body class="dashboard-page">
    <script>
        try {
            if (localStorage.getItem('nutriglow_panel_theme') === 'light') {
                document.body.classList.add('light-mode');
            }
        } catch (error) {
            // El panel funciona igual aunque el navegador bloquee localStorage.
        }
    </script>
    <div class="admin-layout">
        <aside class="sidebar">
            @php
                $panelSectionKey = fn (string $section) => hash_hmac('sha256', $section . '|' . auth()->id() . '|' . session()->token(), (string) config('app.key'));
            @endphp
            <div class="profile-box">
                <div class="profile-avatar">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="profile-info">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p><span class="status-dot"></span> En linea</p>
                </div>
            </div>

            <div class="menu-title">MODULOS</div>

            <nav class="sidebar-menu">
                @if (auth()->user()->role === 'administrador')
                    <a href="{{ route('panel', ['section' => 'usuarios', 'panel_key' => $panelSectionKey('usuarios')]) }}" class="menu-item {{ $activeSection === 'usuarios' ? 'active' : '' }}">
                        <span class="icon">👤</span>
                        <span>Usuarios</span>
                    </a>
                @endif

                <a href="{{ route('panel', ['section' => 'cargas', 'panel_key' => $panelSectionKey('cargas')]) }}" class="menu-item {{ $activeSection === 'cargas' ? 'active' : '' }}">
                    <span class="icon">📸</span>
                    <span>Clientes aplicación</span>
                </a>

                <a href="{{ route('panel', ['section' => 'agenda', 'panel_key' => $panelSectionKey('agenda')]) }}" class="menu-item {{ $activeSection === 'agenda' ? 'active' : '' }}">
                    <span class="icon">&#128197;</span>
                    <span>Registro Citas</span>
                </a>

                <a href="{{ route('panel', ['section' => 'agenda_citas', 'panel_key' => $panelSectionKey('agenda_citas')]) }}" class="menu-item {{ $activeSection === 'agenda_citas' ? 'active' : '' }}">
                    <span class="icon">&#128467;</span>
                    <span>Agenda</span>
                </a>

                <a href="{{ route('panel', ['section' => 'reagendar', 'panel_key' => $panelSectionKey('reagendar')]) }}" class="menu-item {{ $activeSection === 'reagendar' ? 'active' : '' }}">
                    <span class="icon">&#128260;</span>
                    <span>Reagendar cita</span>
                </a>

                <a href="{{ route('panel', ['section' => 'notificaciones', 'panel_key' => $panelSectionKey('notificaciones')]) }}" class="menu-item {{ $activeSection === 'notificaciones' ? 'active' : '' }}">
                    <span class="icon">&#128276;</span>
                    <span>Notificaciones</span>
                </a>

                <a href="{{ route('panel', ['section' => 'facturacion', 'panel_key' => $panelSectionKey('facturacion')]) }}" class="menu-item {{ $activeSection === 'facturacion' ? 'active' : '' }}">
                    <span class="icon">&#128179;</span>
                    <span>Facturacion</span>
                </a>

                <a href="{{ route('panel', ['section' => 'auditoria', 'panel_key' => $panelSectionKey('auditoria')]) }}" class="menu-item {{ $activeSection === 'auditoria' ? 'active' : '' }}">
                    <span class="icon">&#128220;</span>
                    <span>Auditoria</span>
                </a>

                <a href="{{ route('panel', ['section' => 'historial', 'panel_key' => $panelSectionKey('historial'), 'history_user' => $selectedHistoryUser?->id, 'history_range' => $historyRange]) }}" class="menu-item {{ $activeSection === 'historial' ? 'active' : '' }}">
                    <span class="icon">📋</span>
                    <span>Reportes </span>
                </a>

                <a href="{{ route('panel', ['section' => 'recetas', 'panel_key' => $panelSectionKey('recetas'), 'recipe_user' => $selectedRecipeUser?->id, 'recipe_range' => $recipeRange]) }}" class="menu-item {{ $activeSection === 'recetas' ? 'active' : '' }}">
                    <span class="icon">🍽️</span>
                    <span>Seguimiento </span>
                </a>

                <a href="#" class="menu-item" style="display:none;">
                    <span class="icon">📊</span>
                    <span style="display:none;">Estadisticas</span>
                </a>

                <a href="#" class="menu-item" style="display:none;">
                    <span class="icon">⚙️</span>
                    <span>Configuracion</span>
                </a>

                <a href="{{ route('panel', ['section' => 'seguridad', 'panel_key' => $panelSectionKey('seguridad')]) }}" class="menu-item {{ $activeSection === 'seguridad' ? 'active' : '' }}">
                    <span class="icon">🔐</span>
                    <span>Seguridad</span>
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <button type="button" class="menu-toggle">=</button>
                    <strong>Panel administrativo</strong>
                </div>

                <div class="topbar-right">
                    <div class="top-user">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                        <span>{{ auth()->user()->name }}</span>
                    </div>

                    <button type="button" class="theme-toggle" id="themeToggle" aria-label="Cambiar modo del sistema" aria-pressed="false">
                        <span class="theme-toggle-track" aria-hidden="true">
                            <span class="theme-toggle-thumb"></span>
                        </span>
                        <span class="theme-toggle-text" id="themeToggleText">Modo claro</span>
                    </button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Cerrar sesion</button>
                    </form>
                </div>
            </header>

            <section class="dashboard-shell">
                <div class="modules-panel panel-section {{ $activeSection === 'principal' ? 'is-active' : '' }}" data-panel-section="principal">
                    <div class="modules-panel-header">
                        <div>
                            <h2>Modulos del sistema</h2>
                            <p>Vista general del estado de cada apartado del panel.</p>
                        </div>
                        <span class="modules-panel-badge">Panel activo</span>
                    </div>

                    <div class="modules-grid">
                        @if (auth()->user()->role === 'administrador')
                            <article class="module-card">
                                <div class="module-icon">👤</div>
                                <div class="module-copy">
                                    <h3>Usuarios</h3>
                                    <p>Administracion de cuentas, roles y permisos del sistema.</p>
                                </div>
                                <span class="module-status module-status-ready">Disponible</span>
                                <div class="module-action">
                                    <a href="{{ route('panel', ['section' => 'usuarios', 'panel_key' => $panelSectionKey('usuarios')]) }}" class="module-button module-button-primary">Entrar</a>
                                </div>
                            </article>
                        @endif

                        <article class="module-card" style="display:none;">
                            <div class="module-icon">📋</div>
                            <div class="module-copy">
                                <h3>Cargas</h3>
                                <p>Gestion central de contenido y usuarios vinculados al apartado de cargas.</p>
                            </div>
                            <span class="module-status module-status-ready">Disponible</span>
                            <div class="module-action">
                                <a href="{{ route('panel', ['section' => 'cargas', 'panel_key' => $panelSectionKey('cargas')]) }}" class="module-button module-button-primary">Entrar</a>
                            </div>
                        </article>

                        <article class="module-card" style="display:none;">
                            <div class="module-icon">📋</div>
                            <div class="module-copy">
                                <h3>Historial</h3>
                                <p>Seguimiento de operaciones recientes dentro del panel.</p>
                            </div>
                            <span class="module-status module-status-ready">Disponible</span>
                            <div class="module-action">
                                <a href="{{ route('panel', ['section' => 'historial', 'panel_key' => $panelSectionKey('historial'), 'history_user' => $selectedHistoryUser?->id, 'history_range' => $historyRange]) }}" class="module-button module-button-primary">Entrar</a>
                            </div>
                        </article>

                        <article class="module-card" style="display:none;">
                            <div class="module-icon">🍽️</div>
                            <div class="module-copy">
                                <h3>Recetas</h3>
                                <p>Gestion de recetas y contenidos principales del sistema.</p>
                            </div>
                            <span class="module-status module-status-ready">Disponible</span>
                            <div class="module-action">
                                <a href="{{ route('panel', ['section' => 'recetas', 'panel_key' => $panelSectionKey('recetas'), 'recipe_user' => $selectedRecipeUser?->id, 'recipe_range' => $recipeRange]) }}" class="module-button module-button-primary">Entrar</a>
                            </div>
                        </article>

                        <article class="module-card" style="display:none;">
                            <div class="module-icon">📊</div>
                            <div class="module-copy">
                                <h3>Estadisticas</h3>
                                <p>Vista general de reportes, indicadores y progreso.</p>
                            </div>
                            <span class="module-status module-status-pending">En preparacion</span>
                            <div class="module-action">
                                <span class="module-button module-button-muted">Pendiente</span>
                            </div>
                        </article>

                        <article class="module-card">
                            <div class="module-icon">&#128197;</div>
                            <div class="module-copy">
                                <h3>Registro Citas</h3>
                                <p>Programa citas para clientes registrados o nuevos y avisa por correo la fecha y hora.</p>
                            </div>
                            <span class="module-status module-status-ready">Disponible</span>
                            <div class="module-action">
                                <a href="{{ route('panel', ['section' => 'agenda', 'panel_key' => $panelSectionKey('agenda')]) }}" class="module-button module-button-primary">Entrar</a>
                            </div>
                        </article>

                        <article class="module-card">
                            <div class="module-icon">&#128467;</div>
                            <div class="module-copy">
                                <h3>Agenda</h3>
                                <p>Consulta las citas programadas con cliente, fecha, hora y quien la registro.</p>
                            </div>
                            <span class="module-status module-status-ready">Disponible</span>
                            <div class="module-action">
                                <a href="{{ route('panel', ['section' => 'agenda_citas', 'panel_key' => $panelSectionKey('agenda_citas')]) }}" class="module-button module-button-primary">Entrar</a>
                            </div>
                        </article>

                        <article class="module-card">
                            <div class="module-icon">&#128260;</div>
                            <div class="module-copy">
                                <h3>Reagendar cita</h3>
                                <p>Consulta la semana por dias y horas para mover una cita a una nueva fecha.</p>
                            </div>
                            <span class="module-status module-status-ready">Disponible</span>
                            <div class="module-action">
                                <a href="{{ route('panel', ['section' => 'reagendar', 'panel_key' => $panelSectionKey('reagendar')]) }}" class="module-button module-button-primary">Entrar</a>
                            </div>
                        </article>

                        <article class="module-card">
                            <div class="module-icon">&#128179;</div>
                            <div class="module-copy">
                                <h3>Facturacion</h3>
                                <p>Calcula el costo de la cita, agrega compras extra y descarga la factura en PDF.</p>
                            </div>
                            <span class="module-status module-status-ready">Disponible</span>
                            <div class="module-action">
                                <a href="{{ route('panel', ['section' => 'facturacion', 'panel_key' => $panelSectionKey('facturacion')]) }}" class="module-button module-button-primary">Entrar</a>
                            </div>
                        </article>

                        <article class="module-card">
                            <div class="module-icon">&#128220;</div>
                            <div class="module-copy">
                                <h3>Auditoria</h3>
                                <p>Revisa lo facturado, consulta el historial y genera cortes de caja en PDF.</p>
                            </div>
                            <span class="module-status module-status-ready">Disponible</span>
                            <div class="module-action">
                                <a href="{{ route('panel', ['section' => 'auditoria', 'panel_key' => $panelSectionKey('auditoria')]) }}" class="module-button module-button-primary">Entrar</a>
                            </div>
                        </article>

                        <article class="module-card">
                            <div class="module-icon">⚙️</div>
                            <div class="module-copy">
                                <h3>Configuracion</h3>
                                <p>Ajustes generales y preferencias del sistema.</p>
                            </div>
                            <span class="module-status module-status-pending">En preparacion</span>
                            <div class="module-action">
                                <span class="module-button module-button-muted">Pendiente</span>
                            </div>
                        </article>

                        <article class="module-card">
                            <div class="module-icon">🔐</div>
                            <div class="module-copy">
                                <h3>Seguridad</h3>
                            <p>Registro de accesos al sistema con usuario, fecha y hora.</p>
                            </div>
                            <span class="module-status module-status-ready">Disponible</span>
                            <div class="module-action">
                                <a href="{{ route('panel', ['section' => 'seguridad', 'panel_key' => $panelSectionKey('seguridad')]) }}" class="module-button module-button-primary">Entrar</a>
                            </div>
                        </article>
                    </div>
                </div>

                @if (auth()->user()->role === 'administrador')
                    <div class="workspace-shell panel-section {{ $activeSection === 'usuarios' ? 'is-active' : '' }}" data-panel-section="usuarios">
                        <div class="workspace-topbar">
                            <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                                <input type="hidden" name="section" value="usuarios">
                                <input type="hidden" name="panel_key" value="{{ $panelSectionKey('usuarios') }}">
                                <span>⌕</span>
                                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar usuario por nombre o correo">
                                <button type="submit">Buscar</button>
                            </form>

                            <div class="workspace-user">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                                <span>{{ auth()->user()->name }}</span>
                            </div>
                        </div>

                        <div class="workspace-body">
                            <div class="workspace-heading">
                                <div>
                                    <h2>Usuarios</h2>
                                </div>
                                <button type="button" id="toggleSystemUserForm">Crear usuario</button>
                            </div>

                            <div class="workspace-table-shell" id="systemUserFormBox" style="margin-bottom: 20px; display: none;">
                                <div class="workspace-table-toolbar">
                                    <strong id="systemUserFormTitle" style="color:#5a6f90;">Nuevo usuario del sistema</strong>
                                    <button type="button" class="history-filter-button" id="backSystemUserList">Regresar</button>
                                </div>
                                <div style="padding: 22px;">
                                    <form action="{{ route('panel.usuarios.store') }}" method="POST" data-store-action="{{ route('panel.usuarios.store') }}" data-admin-code-url-template="{{ url('/panel/usuarios/__USER__/password-code') }}" data-admin-reset-url-template="{{ url('/panel/usuarios/__USER__/password-reset') }}" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;" data-system-user-form>
                                        @csrf
                                        <div>
                                            <label for="system_name" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Nombre</label>
                                            <input id="system_name" name="name" type="text" required style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        </div>
                                        <div>
                                            <label for="system_email" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Correo</label>
                                            <input id="system_email" name="email" type="email" required style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        </div>
                                        <div id="systemCurrentPasswordField" style="display:none;grid-column:1 / 2;">
                                            <label id="systemCurrentPasswordLabel" for="system_current_password" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Contrasena actual</label>
                                            <div class="password-field">
                                                <input id="system_current_password" name="current_password" type="password" autocomplete="new-password" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                            </div>
                                        </div>
                                        <div style="grid-column:1 / 2;">
                                            <label for="system_password" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Contraseña</label>
                                            <div class="password-field">
                                                <input id="system_password" name="password" type="password" required minlength="8" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}" autocomplete="new-password" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                            </div>
                                            <label class="password-check" for="toggleSystemPassword">
                                                <input id="toggleSystemPassword" type="checkbox">
                                                <span>Mostrar contraseña</span>
                                            </label>
                                            <button type="button" id="goToAdminResetLink" style="display:none;margin-top:10px;padding:0;border:none;background:none;color:#6fbaff;font-size:0.95rem;font-weight:700;cursor:pointer;text-decoration:underline;text-underline-offset:4px;">Olvide mi contrasena</button>
                                        </div>
                                        <div>
                                            <label for="system_role" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Rol</label>
                                            <select id="system_role" name="role" required style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                                <option value="usuario">Usuario</option>
                                                <option value="administrador">Administrador</option>
                                            </select>
                                        </div>
                                        <div style="grid-column:1 / -1;display:flex;justify-content:flex-end;">
                                            <button type="submit" id="systemUserSubmitButton" style="border:none;background:#17a5ff;color:white;padding:12px 20px;border-radius:12px;font-weight:bold;cursor:pointer;">Guardar usuario</button>
                                        </div>
                                        <div class="password-hints" id="systemPasswordHints">
                                            <span data-password-rule="length">Minimo 8 caracteres</span>
                                            <span data-password-rule="case">Mayuscula y minuscula</span>
                                            <span data-password-rule="number">Al menos un numero</span>
                                            <span data-password-rule="symbol">Al menos un simbolo</span>
                                        </div>
                                        <div class="admin-reset-box" id="adminResetBox">
                                            <strong style="color:#d9e7f8;">Cambio seguro para administradores</strong>
                                            <p class="admin-reset-help" style="display:none;"></p>
                                            <div style="display:flex;justify-content:flex-start;">
                                                <button type="button" class="workspace-action-button action-edit" id="sendAdminCodeButton">
                                                    <span>✉</span>
                                                    <span>Enviar codigo</span>
                                                </button>
                                            </div>
                                            <div class="admin-reset-row">
                                                <div>
                                                    <label for="admin_verification_code" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Codigo recibido</label>
                                                    <input id="admin_verification_code" type="text" inputmode="numeric" maxlength="6" placeholder="Ingresa el codigo de 6 digitos" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                                </div>
                                                <button type="button" class="workspace-action-button action-edit" id="confirmAdminCodeButton">
                                                    <span>✓</span>
                                                    <span>Confirmar codigo</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="workspace-table-shell" id="systemUsersListBox">
                                <div class="workspace-table-toolbar">
                                    <strong style="color:#5a6f90;">Usuarios del sistema</strong>
                                </div>

                                <table class="workspace-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="systemUsersTableBody">
                                        @forelse ($systemUsers as $systemUser)
                                            <tr data-system-user-row data-system-user-id="{{ $systemUser->id }}" data-system-user-name="{{ $systemUser->name }}" data-system-user-email="{{ $systemUser->email }}" data-system-user-role="{{ $systemUser->role }}" data-system-user-update-url="{{ route('panel.usuarios.update', $systemUser) }}" data-system-user-delete-url="{{ route('panel.usuarios.destroy', $systemUser) }}" data-system-user-text="{{ strtolower($systemUser->name . ' ' . $systemUser->email) }}">
                                                <td>{{ $systemUser->id }}</td>
                                                <td>
                                                    <div class="workspace-user-chip">
                                                        <div class="workspace-avatar">
                                                            {{ strtoupper(substr($systemUser->name, 0, 1)) }}
                                                        </div>
                                                        <strong>{{ $systemUser->name }}</strong>
                                                    </div>
                                                </td>
                                                <td>{{ $systemUser->email }}</td>
                                                <td>{{ ucfirst($systemUser->role) }}</td>
                                                <td>
                                                    <div class="workspace-actions">
                                                        <button type="button" class="workspace-action-button action-edit" data-system-user-edit title="Editar">
                                                            <span>✎</span>
                                                            <span>Editar</span>
                                                        </button>
                                                        @if ($systemUser->role === 'usuario')
                                                            <button type="button" class="workspace-action-button action-delete" data-system-user-delete title="Eliminar">
                                                                <span>🗑</span>
                                                                <span>Eliminar</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">Todavia no hay usuarios del sistema.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="workspace-shell panel-section {{ $activeSection === 'historial' ? 'is-active' : '' }}" data-panel-section="historial">
                    <div class="workspace-topbar">
                        <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                            <input type="hidden" name="section" value="historial">
                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('historial') }}">
                            <input type="hidden" name="history_user" value="{{ $selectedHistoryUser?->id }}">
                            <input type="hidden" name="history_range" value="{{ $historyRange }}">
                            <span>⌕</span>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar usuario por nombre o DPI">
                            <button type="submit">Buscar</button>
                        </form>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        <div class="workspace-heading">
                            <div>
                                <h2>Historial</h2>
                            </div>
                        </div>

                        <div class="history-layout">
                            <div class="history-users-panel">
                                <div class="history-users-toolbar">
                                    <div class="history-users-search">
                                        <span>⌕</span>
                                        <input type="text" id="historyUserSearch" placeholder="Buscar usuario app">
                                    </div>
                                </div>

                                <div class="history-user-list" id="historyUserList">
                                    @forelse ($historyUsers as $historyUser)
                                        <a
                                            href="{{ route('panel', ['section' => 'historial', 'panel_key' => $panelSectionKey('historial'), 'history_user' => $historyUser->id, 'history_range' => $historyRange, 'history_date' => $historyDate, 'search' => $search]) }}"
                                            class="history-user-link {{ optional($selectedHistoryUser)->id === $historyUser->id ? 'is-active' : '' }}"
                                            data-history-user
                                            data-history-user-text="{{ strtolower($historyUser->nombre . ' ' . $historyUser->dpi) }}"
                                        >
                                            <div class="workspace-avatar">
                                                {{ strtoupper(substr($historyUser->nombre, 0, 1)) }}
                                            </div>
                                            <div class="history-user-meta">
                                                <strong>{{ $historyUser->nombre }}</strong>
                                                <span>{{ $historyUser->dpi }}</span>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="history-empty">Todavia no hay usuarios disponibles en Cargas.</div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="history-records-panel">
                                <div class="history-toolbar">
                                    <div>
                                        <h3>{{ $selectedHistoryUser?->nombre ?? 'Sin usuario seleccionado' }}</h3>
                                    </div>

                                    <div class="history-filters">
                                        <div class="history-filter-group">
                                            @foreach ([5, 15, 30] as $rangeOption)
                                                <a
                                                    href="{{ route('panel', ['section' => 'historial', 'panel_key' => $panelSectionKey('historial'), 'history_user' => $selectedHistoryUser?->id, 'history_range' => $rangeOption, 'search' => $search]) }}"
                                                    class="history-filter-button {{ $historyRange === $rangeOption && $historyDate === '' ? 'is-active' : '' }}"
                                                >
                                                    {{ $rangeOption }} dias
                                                </a>
                                            @endforeach
                                        </div>

                                        <form action="{{ route('panel') }}" method="GET" class="history-date-form">
                                            <input type="hidden" name="section" value="historial">
                                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('historial') }}">
                                            <input type="hidden" name="history_user" value="{{ $selectedHistoryUser?->id }}">
                                            <input type="hidden" name="history_range" value="{{ $historyRange }}">
                                            <input type="hidden" name="search" value="{{ $search }}">
                                            <input type="date" name="history_date" value="{{ $historyDate }}">
                                            <button type="submit">Filtrar fecha</button>
                                            @if ($historyDate !== '')
                                                <a href="{{ route('panel', ['section' => 'historial', 'panel_key' => $panelSectionKey('historial'), 'history_user' => $selectedHistoryUser?->id, 'history_range' => $historyRange, 'search' => $search]) }}" class="history-date-clear">Limpiar</a>
                                            @endif
                                        </form>
                                    </div>
                                </div>

                                @if ($selectedHistoryUser)
                                    <div class="history-days-shell" id="historyDaysShell">
                                        <table class="history-days-table">
                                            <thead>
                                                <tr>
                                                    <th>Dia</th>
                                                    <th>Fecha y hora</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($historyEntries as $historyEntry)
                                                    <tr>
                                                        <td>
                                                            <button
                                                                type="button"
                                                                class="history-day-button"
                                                                data-history-day
                                                                data-history-fecha="{{ $historyEntry['fecha'] }}"
                                                                data-history-hora="{{ $historyEntry['hora'] }}"
                                                                data-history-titulo="{{ $historyEntry['titulo'] !== '' ? $historyEntry['titulo'] : 'En blanco' }}"
                                                                data-history-calorias="{{ $historyEntry['calorias'] !== '' ? $historyEntry['calorias'] : 'En blanco' }}"
                                                                data-history-carbohidratos="{{ $historyEntry['carbohidratos'] !== '' ? $historyEntry['carbohidratos'] : 'En blanco' }}"
                                                                data-history-proteina="{{ $historyEntry['proteina'] !== '' ? $historyEntry['proteina'] : 'En blanco' }}"
                                                                data-history-grasas="{{ $historyEntry['grasas'] !== '' ? $historyEntry['grasas'] : 'En blanco' }}"
                                                            >
                                                                <strong>{{ $historyEntry['fecha'] }}</strong>
                                                                <span>Ver detalle</span>
                                                            </button>
                                                        </td>
                                                        <td>{{ $historyEntry['fecha'] }} {{ $historyEntry['hora'] }}</td>
                                                        <td><span class="history-day-badge">Pendiente</span></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="history-day-detail" id="historyDayDetail">
                                        <div class="history-day-detail-info">
                                            <div class="history-day-detail-top">
                                                <h4>Detalle del dia</h4>
                                                <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                                                    <span class="history-day-detail-date" id="historyDetailDate">Selecciona un dia</span>
                                                    <button type="button" class="history-back-button" id="historyBackButton">Volver</button>
                                                </div>
                                            </div>

                                            <div class="history-day-detail-grid">
                                                <div class="history-day-detail-item">
                                                    <span>Titulo</span>
                                                    <strong id="historyDetailTitulo">En blanco</strong>
                                                </div>
                                                <div class="history-day-detail-item">
                                                    <span>Calorias</span>
                                                    <strong id="historyDetailCalorias">En blanco</strong>
                                                </div>
                                                <div class="history-day-detail-item">
                                                    <span>Carbohidratos</span>
                                                    <strong id="historyDetailCarbohidratos">En blanco</strong>
                                                </div>
                                                <div class="history-day-detail-item">
                                                    <span>Proteina</span>
                                                    <strong id="historyDetailProteina">En blanco</strong>
                                                </div>
                                                <div class="history-day-detail-item">
                                                    <span>Grasas</span>
                                                    <strong id="historyDetailGrasas">En blanco</strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="history-day-detail-image">
                                            <h4>Imagen</h4>
                                            <div class="workspace-image-placeholder">
                                                Imagen pendiente
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="history-empty">
                                        Todavia no hay usuarios para mostrar el historial.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="workspace-shell panel-section {{ $activeSection === 'recetas' ? 'is-active' : '' }}" data-panel-section="recetas">
                    <div class="workspace-topbar">
                        <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                            <input type="hidden" name="section" value="recetas">
                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('recetas') }}">
                            <input type="hidden" name="recipe_range" value="{{ $recipeRange }}">
                            <input type="hidden" name="recipe_user" value="{{ $selectedRecipeUser?->id }}">
                            <span>⌕</span>
                            <input type="text" name="search" id="recipeSearchInput" value="{{ $search ?? '' }}" placeholder="Buscar usuario por nombre o DPI">
                            <button type="submit">Buscar</button>
                        </form>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        @if (session('success_recetas'))
                            <div class="modules-panel-badge" style="display:inline-flex;margin-bottom:18px;">
                                {{ session('success_recetas') }}
                            </div>
                        @endif

                        <div class="workspace-heading">
                            <div>
                                <h2>Recetas</h2>
                            </div>
                        </div>

                        <div class="history-records-panel">
                            <div class="history-toolbar" id="recipeListToolbar" style="{{ $selectedRecipeUser ? 'display:none;' : '' }}">
                                <div>
                                    <h3>Clasificacion de usuarios</h3>
                                </div>

                                <div class="history-filter-group">
                                    @foreach (['todos' => 'Todos', 'alto' => 'Altos', 'medio' => 'Medios', 'bajo' => 'Bajos'] as $rangeValue => $rangeLabel)
                                        <a
                                            href="{{ route('panel', ['section' => 'recetas', 'panel_key' => $panelSectionKey('recetas'), 'recipe_range' => $rangeValue, 'search' => $search]) }}"
                                            class="history-filter-button {{ $recipeRange === $rangeValue ? 'is-active' : '' }}"
                                        >
                                            {{ $rangeLabel }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="history-days-shell" id="recipeListShell" style="{{ $selectedRecipeUser ? 'display:none;' : '' }}">
                                <table class="history-days-table">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Correo</th>
                                            <th>DPI</th>
                                            <th>Rango</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recipeUsers as $recipeUser)
                                            @php
                                                $recipeUserRange = $recipeUser->rango_receta ?: 'bajo';
                                            @endphp
                                                <tr data-recipe-row data-recipe-text="{{ strtolower($recipeUser->nombre . ' ' . $recipeUser->dpi) }}" data-recipe-range="{{ $recipeUserRange }}" data-recipe-name="{{ strtolower($recipeUser->nombre) }}">
                                                <td>
                                                    <a
                                                        href="{{ route('panel', ['section' => 'recetas', 'panel_key' => $panelSectionKey('recetas'), 'recipe_user' => $recipeUser->id, 'recipe_range' => $recipeRange, 'search' => $search]) }}"
                                                        class="history-user-link {{ optional($selectedRecipeUser)->id === $recipeUser->id ? 'is-active' : '' }}"
                                                        style="display:inline-flex;padding:8px 10px;"
                                                        data-recipe-open
                                                        data-recipe-user-id="{{ $recipeUser->id }}"
                                                    >
                                                        <div class="workspace-avatar">
                                                            {{ strtoupper(substr($recipeUser->nombre, 0, 1)) }}
                                                        </div>
                                                        <div class="history-user-meta">
                                                            <strong>{{ $recipeUser->nombre }}</strong>
                                                            <span>{{ $recipeUser->dpi }}</span>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{ $recipeUser->correo }}</td>
                                                <td>{{ $recipeUser->dpi }}</td>
                                                <td>
                                                    <form action="{{ route('panel.recetas.rango', ['usariosapp' => $recipeUser, 'recipe_range' => $recipeRange, 'search' => $search]) }}" method="POST" class="recipe-range-form">
                                                        @csrf
                                                        <select name="rango_receta" class="recipe-range-select recipe-range-{{ $recipeUserRange }}" data-recipe-range-select data-current-range="{{ $recipeUserRange }}" aria-label="Cambiar clasificacion de {{ $recipeUser->nombre }}">
                                                            <option value="alto" @selected($recipeUserRange === 'alto')>Alto</option>
                                                            <option value="medio" @selected($recipeUserRange === 'medio')>Medio</option>
                                                            <option value="bajo" @selected($recipeUserRange === 'bajo')>Bajo</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="{{ route('panel', ['section' => 'recetas', 'panel_key' => $panelSectionKey('recetas'), 'recipe_user' => $recipeUser->id, 'recipe_range' => $recipeRange, 'search' => $search]) }}" class="history-filter-button" data-recipe-open data-recipe-user-id="{{ $recipeUser->id }}">Enviar opinion</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No hay usuarios en este rango.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @foreach ($recipeUsers as $recipeDetailUser)
                                @php
                                    $isSelectedRecipeDetail = optional($selectedRecipeUser)->id === $recipeDetailUser->id;
                                @endphp
                                <div class="recipe-detail" data-recipe-detail="{{ $recipeDetailUser->id }}" style="{{ $isSelectedRecipeDetail ? '' : 'display:none;' }}">
                                    <div>
                                        <div class="history-toolbar" style="padding:0 0 18px;border-bottom:none;">
                                            <div>
                                                <h3>{{ $recipeDetailUser->nombre }}</h3>
                                            </div>
                                            <a href="{{ route('panel', ['section' => 'recetas', 'panel_key' => $panelSectionKey('recetas'), 'recipe_range' => $recipeRange, 'search' => $search]) }}" class="history-filter-button" data-recipe-back>Regresar</a>
                                        </div>

                                        @if ($isSelectedRecipeDetail && $errors->any())
                                            <div style="margin-bottom:16px;padding:12px 14px;border-radius:12px;background:rgba(255,92,131,0.12);color:#d95b7d;border:1px solid rgba(255,92,131,0.18);">
                                                <ul style="margin:0;padding-left:18px;">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form action="{{ route('panel.recetas.update', ['usariosapp' => $recipeDetailUser, 'recipe_range' => $recipeRange]) }}" method="POST" enctype="multipart/form-data" class="recipe-form" data-recipe-form>
                                            @csrf

                                            <div class="recipe-field">
                                                <label for="receta_opinion_{{ $recipeDetailUser->id }}">Opinion para este usuario</label>
                                                <textarea id="receta_opinion_{{ $recipeDetailUser->id }}" name="receta_opinion" placeholder="Escribe la recomendacion u opinion para este usuario.">{{ $isSelectedRecipeDetail ? old('receta_opinion', $recipeDetailUser->receta_opinion) : $recipeDetailUser->receta_opinion }}</textarea>
                                            </div>

                                            <div class="recipe-field">
                                                <label for="receta_imagen_{{ $recipeDetailUser->id }}">Foto de referencia</label>
                                                <input id="receta_imagen_{{ $recipeDetailUser->id }}" name="receta_imagen" type="file" accept="image/*">
                                            </div>

                                            <button type="submit" class="recipe-submit">Enviar opinion</button>
                                        </form>
                                    </div>

                                    <div>
                                        <h3 style="color:#5a6f90;margin-bottom:18px;">Referencia</h3>
                                        <div class="recipe-image-preview" data-recipe-image-preview>
                                            @if ($recipeDetailUser->receta_imagen)
                                                <img src="{{ $recipeDetailUser->receta_imagen_url }}" alt="Referencia de receta">
                                            @else
                                                Imagen pendiente
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="workspace-shell panel-section {{ $activeSection === 'cargas' ? 'is-active' : '' }}" data-panel-section="cargas">
                    <div class="workspace-topbar">
                        <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                            <input type="hidden" name="section" value="cargas">
                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('cargas') }}">
                            <span>⌕</span>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar por nombre o DPI">
                            <button type="submit">Buscar</button>
                        </form>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        @if (session('success_cargas'))
                            <div class="modules-panel-badge" style="display:inline-flex;margin-bottom:18px;">
                                {{ session('success_cargas') }}
                            </div>
                        @endif

                        <div class="workspace-stats">
                            <article class="workspace-stat">
                                <div class="workspace-stat-top">
                                    <h3>Usuarios actuales</h3>
                                    <small>30 dias</small>
                                </div>
                                <div class="workspace-stat-value">
                                    <div class="workspace-stat-icon">📘</div>
                                    <div class="workspace-stat-number">{{ $uploadUsers->count() }}</div>
                                </div>
                            </article>

                            <article class="workspace-stat">
                                <div class="workspace-stat-top">
                                    <h3>Nuevas cargas</h3>
                                    <small>Meta mensual</small>
                                </div>
                                <div class="workspace-stat-number">72%</div>
                                <div class="workspace-progress">
                                    <span></span>
                                </div>
                            </article>
                        </div>

                        <div class="workspace-heading">
                            <div>
                                <h2>Cargas</h2>
                            </div>
                            <button type="button" id="toggleCargaForm">Crear usuario</button>
                        </div>

                        <div class="workspace-table-shell" id="cargaFormBox" style="margin-bottom: 20px; display: {{ $errors->any() ? 'block' : 'none' }};">
                            <div class="workspace-table-toolbar">
                                <strong id="cargaFormTitle" style="color:#5a6f90;">Nuevo usuario de Cargas</strong>
                                <button type="button" id="backCargaList" class="workspace-action-button action-edit" style="display:none;">
                                    <span>Regresar</span>
                                </button>
                            </div>
                            <div style="padding: 22px;">
                                @if ($errors->any())
                                    <div style="margin-bottom:16px;padding:12px 14px;border-radius:12px;background:rgba(255,92,131,0.12);color:#d95b7d;border:1px solid rgba(255,92,131,0.18);">
                                        <ul style="margin:0;padding-left:18px;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form
                                    action="{{ old('carga_editing_id') ? route('panel.cargas.update', old('carga_editing_id')) : route('panel.cargas.store') }}"
                                    method="POST"
                                    id="cargaUserForm"
                                    data-carga-user-form
                                    data-store-action="{{ route('panel.cargas.store') }}"
                                    data-update-url-template="{{ url('/panel/cargas/usuarios/__USER__') }}"
                                    style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;"
                                >
                                    @csrf
                                    <input id="carga_editing_id" name="carga_editing_id" type="hidden" value="{{ old('carga_editing_id', '') }}">
                                    <div>
                                        <label for="nombre" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Nombre</label>
                                        <input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                    </div>
                                    <div>
                                        <label for="correo" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Correo</label>
                                        <input id="correo" name="correo" type="email" value="{{ old('correo') }}" required style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                    </div>
                                    <div>
                                        <label for="dpi" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">DPI</label>
                                        <input id="dpi" name="dpi" type="text" value="" required inputmode="numeric" pattern="[0-9]{13}" maxlength="13" minlength="13" placeholder="13 digitos" autocomplete="off" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                    </div>
                                    <div>
                                        <label for="password" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Contraseña</label>
                                        <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        <label class="password-check" for="toggleCargaPassword" style="margin-top:10px;">
                                            <input id="toggleCargaPassword" type="checkbox">
                                            <span>Mostrar contraseña</span>
                                        </label>
                                    </div>
                                    <div style="grid-column:1 / -1;display:flex;justify-content:flex-end;">
                                        <button id="cargaSubmitButton" type="submit" style="border:none;background:#17a5ff;color:white;padding:12px 20px;border-radius:12px;font-weight:bold;cursor:pointer;">Guardar usuario</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="workspace-table-shell" id="cargasListBox">
                            <div class="workspace-table-toolbar">
                                <form action="{{ route('panel') }}" method="GET" class="workspace-table-search">
                                    <input type="hidden" name="section" value="cargas">
                                    <input type="hidden" name="panel_key" value="{{ $panelSectionKey('cargas') }}">
                                    <span>⌕</span>
                                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar por nombre o DPI">
                                </form>
                            </div>

                            <table class="workspace-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>DPI</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="cargasTableBody">
                                    @forelse ($uploadUsers as $uploadUser)
                                        <tr
                                            data-search-row
                                            data-carga-user-id="{{ $uploadUser->id }}"
                                            data-carga-user-nombre="{{ $uploadUser->nombre }}"
                                            data-carga-user-correo="{{ $uploadUser->correo }}"
                                            data-carga-user-dpi="{{ $uploadUser->dpi }}"
                                            data-carga-user-update-url="{{ route('panel.cargas.update', $uploadUser) }}"
                                            data-search-text="{{ strtolower($uploadUser->nombre . ' ' . $uploadUser->dpi) }}"
                                        >
                                            <td>{{ $uploadUser->id }}</td>
                                            <td>
                                                <button type="button" class="workspace-user-chip workspace-user-trigger" data-user-id="{{ $uploadUser->id }}" data-user-nombre="{{ $uploadUser->nombre }}" data-user-correo="{{ $uploadUser->correo }}" data-user-dpi="{{ $uploadUser->dpi }}">
                                                    <div class="workspace-avatar">
                                                        {{ strtoupper(substr($uploadUser->nombre, 0, 1)) }}
                                                    </div>
                                                    <strong>{{ $uploadUser->nombre }}</strong>
                                                </button>
                                            </td>
                                            <td>{{ $uploadUser->correo }}</td>
                                            <td>{{ $uploadUser->dpi }}</td>
                                            <td>
                                                <div class="workspace-actions">
                                                    <button type="button" class="workspace-action-button action-edit" data-carga-edit-button><span>Editar</span></button>
                                                    <form action="{{ route('panel.cargas.destroy', $uploadUser) }}" method="POST" data-carga-delete-form>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="workspace-action-button action-delete" data-carga-delete-button><span>Eliminar</span></button>
                                                    </form>
                                                    <span class="workspace-action">👁</span>
                                                    <span class="workspace-action">✎</span>
                                                    <span class="workspace-action">🗑</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Todavia no hay usuarios en Cargas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="workspace-detail" id="workspaceDetail">
                            <div class="workspace-detail-info">
                                <h3>Detalle del usuario</h3>
                                <div class="workspace-detail-list">
                                    <div class="workspace-detail-item">
                                        <span>ID</span>
                                        <strong id="detailUserId">Selecciona un usuario</strong>
                                    </div>
                                    <div class="workspace-detail-item">
                                        <span>Nombre</span>
                                        <strong id="detailUserNombre">Sin seleccionar</strong>
                                    </div>
                                    <div class="workspace-detail-item">
                                        <span>Correo</span>
                                        <strong id="detailUserCorreo">Sin seleccionar</strong>
                                    </div>
                                    <div class="workspace-detail-item">
                                        <span>DPI</span>
                                        <strong id="detailUserDpi">Sin seleccionar</strong>
                                    </div>
                                    <div class="workspace-detail-item">
                                        <span>Titulo</span>
                                        <strong id="detailUserTitulo">En blanco</strong>
                                    </div>
                                    <div class="workspace-detail-item">
                                        <span>Calorias</span>
                                        <strong id="detailUserCalorias">En blanco</strong>
                                    </div>
                                    <div class="workspace-detail-item">
                                        <span>Carbohidratos</span>
                                        <strong id="detailUserCarbohidratos">En blanco</strong>
                                    </div>
                                    <div class="workspace-detail-item">
                                        <span>Proteina</span>
                                        <strong id="detailUserProteina">En blanco</strong>
                                    </div>
                                    <div class="workspace-detail-item">
                                        <span>Grasas</span>
                                        <strong id="detailUserGrasas">En blanco</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="workspace-detail-image">
                                <h3>Imagen</h3>
                                <div class="workspace-image-placeholder">
                                    Imagen pendiente
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="workspace-shell panel-section {{ $activeSection === 'agenda' ? 'is-active' : '' }}" data-panel-section="agenda">
                    <div class="workspace-topbar">
                        <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                            <input type="hidden" name="section" value="agenda">
                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('agenda') }}">
                            <span>⌕</span>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar cliente por nombre, correo o DPI">
                            <button type="submit">Buscar</button>
                        </form>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        @if (session('success_agenda'))
                            <div class="modules-panel-badge" style="display:inline-flex;margin-bottom:18px;">
                                {{ session('success_agenda') }}
                            </div>
                        @endif

                        <div class="workspace-heading">
                            <div>
                                <h2>Registro Citas</h2>
                            </div>
                        </div>

                        <div style="display:grid;grid-template-columns:minmax(0,1.1fr) minmax(320px,0.9fr);gap:20px;">
                            <div class="workspace-table-shell">
                                <div class="workspace-table-toolbar">
                                    <strong style="color:#5a6f90;">Nueva cita</strong>
                                </div>
                                <div style="padding:22px;">
                                    @if ($errors->any() && $activeSection === 'agenda')
                                        <div style="margin-bottom:16px;padding:12px 14px;border-radius:12px;background:rgba(255,92,131,0.12);color:#d95b7d;border:1px solid rgba(255,92,131,0.18);">
                                            <ul style="margin:0;padding-left:18px;">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('panel.agenda.store') }}" method="POST" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
                                        @csrf
                                        @php
                                            $agendaClientType = old('agenda_client_type', 'existente');
                                        @endphp
                                        <div style="grid-column:1 / -1;">
                                            <label style="display:block;margin-bottom:10px;color:#5a6f90;font-weight:bold;">Tipo de cliente</label>
                                            <div style="display:flex;gap:18px;flex-wrap:wrap;">
                                                <label style="display:inline-flex;align-items:center;gap:8px;color:#4f6483;font-weight:600;">
                                                    <input type="radio" name="agenda_client_type" value="existente" {{ $agendaClientType === 'existente' ? 'checked' : '' }} data-agenda-type>
                                                    <span>Cliente registrado</span>
                                                </label>
                                                <label style="display:inline-flex;align-items:center;gap:8px;color:#4f6483;font-weight:600;">
                                                    <input type="radio" name="agenda_client_type" value="nuevo" {{ $agendaClientType === 'nuevo' ? 'checked' : '' }} data-agenda-type>
                                                    <span>Cliente nuevo</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div id="agendaExistingFields" style="grid-column:1 / -1;display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;{{ $agendaClientType === 'nuevo' ? 'display:none;' : '' }}">
                                            <input id="agenda_usariosapp_id" name="usariosapp_id" type="hidden" value="{{ old('usariosapp_id') }}">
                                            <div>
                                                <label for="agenda_existing_nombre" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Nombre del cliente</label>
                                                <input id="agenda_existing_nombre" type="text" value="{{ old('usariosapp_id') ? optional($agendaClients->firstWhere('id', (int) old('usariosapp_id')))->nombre : '' }}" placeholder="Selecciona un cliente disponible" readonly style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f3f7fd;color:#4f6483;outline:none;">
                                            </div>
                                            <div>
                                                <label for="agenda_existing_correo" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Correo del cliente</label>
                                                <input id="agenda_existing_correo" type="email" value="{{ old('usariosapp_id') ? optional($agendaClients->firstWhere('id', (int) old('usariosapp_id')))->correo : '' }}" placeholder="Se llenara al hacer clic en un cliente" readonly style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f3f7fd;color:#4f6483;outline:none;">
                                            </div>
                                        </div>

                                        <div id="agendaNewNameField" style="{{ $agendaClientType === 'existente' ? 'display:none;' : '' }}">
                                            <label for="agenda_cliente_nombre" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Nombre del cliente</label>
                                            <input id="agenda_cliente_nombre" name="cliente_nombre" type="text" value="{{ old('cliente_nombre') }}" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        </div>

                                        <div id="agendaNewEmailField" style="{{ $agendaClientType === 'existente' ? 'display:none;' : '' }}">
                                            <label for="agenda_cliente_correo" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Correo del cliente</label>
                                            <input id="agenda_cliente_correo" name="cliente_correo" type="email" value="{{ old('cliente_correo') }}" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        </div>

                                        <div style="grid-column:1 / -1;">
                                            <label for="agenda_appointment_at" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Dia y hora de la cita</label>
                                            <input id="agenda_appointment_at" name="appointment_at" type="datetime-local" min="{{ now()->format('Y-m-d\TH:i') }}" value="{{ old('appointment_at') }}" required style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        </div>

                                        <div style="grid-column:1 / -1;display:flex;justify-content:flex-end;">
                                            <button type="submit" style="border:none;background:#17a5ff;color:white;padding:12px 20px;border-radius:12px;font-weight:bold;cursor:pointer;">Crear cita</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="workspace-table-shell">
                                <div class="workspace-table-toolbar">
                                    <strong style="color:#5a6f90;">Clientes disponibles</strong>
                                </div>
                                <div style="padding:22px;display:grid;gap:12px;max-height:520px;overflow:auto;">
                                    <div class="workspace-table-search" style="margin-bottom:6px;">
                                        <span>⌕</span>
                                        <input type="text" id="agendaClientSearch" placeholder="Buscar cliente en tiempo real">
                                    </div>

                                    @forelse ($agendaClients as $agendaClient)
                                        <button
                                            type="button"
                                            class="history-user-link"
                                            style="cursor:pointer;text-align:left;background:transparent;width:100%;"
                                            data-agenda-client-card
                                            data-agenda-client-text="{{ strtolower($agendaClient->nombre . ' ' . $agendaClient->correo . ' ' . ($agendaClient->dpi ?? '')) }}"
                                            data-agenda-client-id="{{ $agendaClient->id }}"
                                            data-agenda-client-nombre="{{ $agendaClient->nombre }}"
                                            data-agenda-client-correo="{{ $agendaClient->correo }}"
                                        >
                                            <div class="workspace-avatar">{{ strtoupper(substr($agendaClient->nombre, 0, 1)) }}</div>
                                            <div class="history-user-meta">
                                                <strong>{{ $agendaClient->nombre }}</strong>
                                                <span>{{ $agendaClient->correo }}</span>
                                            </div>
                                        </button>
                                    @empty
                                        <div class="history-empty">Todavia no hay clientes registrados en aplicacion.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="workspace-shell panel-section {{ $activeSection === 'agenda_citas' ? 'is-active' : '' }}" data-panel-section="agenda_citas">
                    <div class="workspace-topbar">
                        <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                            <input type="hidden" name="section" value="agenda_citas">
                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('agenda_citas') }}">
                            <span>⌕</span>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar cita por cliente o correo">
                            <button type="submit">Buscar</button>
                        </form>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        <div class="workspace-heading">
                            <div>
                                <h2>Agenda</h2>
                                <p style="margin-top:8px;color:#8aa0be;">Citas del dia {{ $agendaToday->format('d/m/Y') }} en horario de Guatemala.</p>
                            </div>
                        </div>

                        <div class="workspace-table-shell">
                            <div class="workspace-table-toolbar">
                                <strong style="color:#5a6f90;">Citas pendientes del dia</strong>
                            </div>
                            <div style="padding:0 22px 22px;">
                                <div class="workspace-table-wrap">
                                    <table class="workspace-table">
                                        <thead>
                                            <tr>
                                                <th>Estado</th>
                                                <th>Cliente</th>
                                                <th>Correo</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Origen</th>
                                                <th>Creada por</th>
                                            </tr>
                                        </thead>
                                        <tbody id="agendaPendingTableBody">
                                            @forelse ($agendaPendingAppointments as $agendaAppointment)
                                                <tr
                                                    data-agenda-appointment-row
                                                    data-agenda-appointment-id="{{ $agendaAppointment->id }}"
                                                    data-agenda-status-url="{{ route('panel.agenda.status', $agendaAppointment) }}"
                                                    data-agenda-completed="0"
                                                    data-agenda-appointment-at="{{ $agendaAppointment->appointment_at->copy()->timezone(config('app.timezone', 'America/Guatemala'))->toIso8601String() }}"
                                                >
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="agenda-status-button {{ $agendaAppointment->appointment_at->copy()->addMinutes(30)->gt($agendaToday) ? 'is-upcoming' : 'is-pending' }}"
                                                            data-agenda-status-button
                                                            aria-label="Marcar cita como completada"
                                                            title="Marcar como completada"
                                                        ></button>
                                                    </td>
                                                    <td>{{ $agendaAppointment->cliente_nombre }}</td>
                                                    <td>{{ $agendaAppointment->cliente_correo }}</td>
                                                    <td>{{ $agendaAppointment->appointment_at->format('d/m/Y') }}</td>
                                                    <td>{{ $agendaAppointment->appointment_at->format('H:i') }}</td>
                                                    <td>{{ $agendaAppointment->usariosapp_id ? 'Cliente registrado' : 'Cliente nuevo' }}</td>
                                                    <td>{{ $agendaAppointment->creator?->name ?? 'Sistema' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" style="text-align:center;">No hay citas pendientes para hoy.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="workspace-table-shell" style="margin-top:20px;">
                            <div class="workspace-table-toolbar">
                                <strong style="color:#5a6f90;">Citas completadas del dia</strong>
                            </div>
                            <div style="padding:0 22px 22px;">
                                <div class="workspace-table-wrap">
                                    <table class="workspace-table">
                                        <thead>
                                            <tr>
                                                <th>Estado</th>
                                                <th>Cliente</th>
                                                <th>Correo</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Origen</th>
                                                <th>Creada por</th>
                                            </tr>
                                        </thead>
                                        <tbody id="agendaCompletedTableBody">
                                            @forelse ($agendaCompletedAppointments as $agendaAppointment)
                                                <tr
                                                    data-agenda-appointment-row
                                                    data-agenda-appointment-id="{{ $agendaAppointment->id }}"
                                                    data-agenda-status-url="{{ route('panel.agenda.status', $agendaAppointment) }}"
                                                    data-agenda-completed="1"
                                                    data-agenda-appointment-at="{{ $agendaAppointment->appointment_at->copy()->timezone(config('app.timezone', 'America/Guatemala'))->toIso8601String() }}"
                                                >
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="agenda-status-button is-completed"
                                                            data-agenda-status-button
                                                            aria-label="Devolver cita a pendientes"
                                                            title="Devolver a pendientes"
                                                        ></button>
                                                    </td>
                                                    <td>{{ $agendaAppointment->cliente_nombre }}</td>
                                                    <td>{{ $agendaAppointment->cliente_correo }}</td>
                                                    <td>{{ $agendaAppointment->appointment_at->format('d/m/Y') }}</td>
                                                    <td>{{ $agendaAppointment->appointment_at->format('H:i') }}</td>
                                                    <td>{{ $agendaAppointment->usariosapp_id ? 'Cliente registrado' : 'Cliente nuevo' }}</td>
                                                    <td>{{ $agendaAppointment->creator?->name ?? 'Sistema' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" style="text-align:center;">No hay citas completadas para hoy.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($securityView === 'historial' && $securityHasMore)
                                    <div style="display:flex;justify-content:center;margin-top:18px;">
                                        <a href="{{ route('panel', ['section' => 'seguridad', 'panel_key' => $panelSectionKey('seguridad'), 'security_view' => 'historial', 'security_limit' => $securityLimit + 10]) }}" class="history-filter-button">Ver mas</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="workspace-shell panel-section {{ $activeSection === 'reagendar' ? 'is-active' : '' }}" data-panel-section="reagendar">
                    <div class="workspace-topbar">
                        <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                            <input type="hidden" name="section" value="reagendar">
                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('reagendar') }}">
                            <input type="hidden" name="reschedule_week" value="{{ $rescheduleWeekStart->format('Y-m-d') }}">
                            <span>⌕</span>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar cita por cliente o correo">
                            <button type="submit">Buscar</button>
                        </form>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        @if (session('success_reagendar'))
                            <div class="modules-panel-badge" style="display:inline-flex;margin-bottom:18px;">
                                {{ session('success_reagendar') }}
                            </div>
                        @endif

                        @if ($errors->any() && $activeSection === 'reagendar')
                            <div style="margin-bottom:16px;padding:12px 14px;border-radius:12px;background:rgba(255,92,131,0.12);color:#d95b7d;border:1px solid rgba(255,92,131,0.18);">
                                <ul style="margin:0;padding-left:18px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (! $selectedRescheduleAppointment)
                            <div class="workspace-heading">
                                <div>
                                    <h2>Reagendar cita</h2>
                                    <p style="margin-top:8px;color:#8aa0be;">Semana del {{ $rescheduleWeekStart->format('d/m/Y') }} al {{ $rescheduleWeekEnd->format('d/m/Y') }}. Horario permitido: 08:00 a 17:00.</p>
                                </div>
                                <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                                    <a href="{{ route('panel', ['section' => 'reagendar', 'panel_key' => $panelSectionKey('reagendar'), 'reschedule_week' => $rescheduleWeekStart->copy()->subWeek()->format('Y-m-d'), 'search' => $search]) }}" class="history-filter-button">Semana anterior</a>
                                    <a href="{{ route('panel', ['section' => 'reagendar', 'panel_key' => $panelSectionKey('reagendar')]) }}" class="history-filter-button">Hoy</a>
                                    <a href="{{ route('panel', ['section' => 'reagendar', 'panel_key' => $panelSectionKey('reagendar'), 'reschedule_week' => $rescheduleWeekStart->copy()->addWeek()->format('Y-m-d'), 'search' => $search]) }}" class="history-filter-button">Semana siguiente</a>
                                </div>
                            </div>

                            <div class="workspace-table-shell">
                                <div class="workspace-table-toolbar">
                                    <strong style="color:#5a6f90;">Calendario semanal de citas</strong>
                                </div>
                                <div style="padding:22px;">
                                    <div class="reschedule-week-shell">
                                        <div class="reschedule-week-grid">
                                            <div class="reschedule-week-head time">Hora</div>
                                            @foreach ($rescheduleWeekDays as $rescheduleDay)
                                                <div class="reschedule-week-head">
                                                    {{ ucfirst($rescheduleDay->locale('es')->translatedFormat('l')) }}<br>
                                                    <span style="font-size:0.82rem;color:#6f88ad;">{{ $rescheduleDay->format('d/m') }}</span>
                                                </div>
                                            @endforeach

                                            @foreach ($rescheduleHours as $rescheduleHour)
                                                <div class="reschedule-time-slot">{{ str_pad((string) $rescheduleHour, 2, '0', STR_PAD_LEFT) }}:00</div>
                                                @foreach ($rescheduleWeekDays as $rescheduleDay)
                                                    @php
                                                        $rescheduleDayKey = $rescheduleDay->format('Y-m-d');
                                                        $rescheduleHourKey = str_pad((string) $rescheduleHour, 2, '0', STR_PAD_LEFT);
                                                        $appointmentsInCell = $rescheduleCalendar[$rescheduleDayKey][$rescheduleHourKey] ?? [];
                                                    @endphp
                                                    <div class="reschedule-day-cell">
                                                        @foreach ($appointmentsInCell as $calendarAppointment)
                                                            @php
                                                                $calendarAppointmentCompleted = (bool) $calendarAppointment->is_completed;
                                                                $calendarAppointmentUpcoming = ! $calendarAppointmentCompleted && $calendarAppointment->appointment_at->copy()->addMinutes(30)->gt($agendaToday);
                                                                $calendarAppointmentStateClass = $calendarAppointmentCompleted
                                                                    ? 'is-completed'
                                                                    : ($calendarAppointmentUpcoming ? 'is-upcoming' : 'is-due');
                                                            @endphp
                                                            <a
                                                                href="{{ route('panel', ['section' => 'reagendar', 'panel_key' => $panelSectionKey('reagendar'), 'reschedule_week' => $rescheduleWeekStart->format('Y-m-d'), 'reschedule_appointment' => $calendarAppointment->id, 'search' => $search]) }}"
                                                                class="reschedule-appointment-link {{ $calendarAppointmentStateClass }}"
                                                                data-reschedule-appointment-id="{{ $calendarAppointment->id }}"
                                                                data-reschedule-appointment-at="{{ $calendarAppointment->appointment_at->copy()->timezone(config('app.timezone', 'America/Guatemala'))->toIso8601String() }}"
                                                                data-reschedule-completed="{{ $calendarAppointmentCompleted ? '1' : '0' }}"
                                                            >
                                                                <span class="reschedule-appointment-time">{{ $calendarAppointment->appointment_at->format('H:i') }}</span>
                                                                <span class="reschedule-appointment-name">{{ $calendarAppointment->cliente_nombre }}</span>
                                                                <span class="reschedule-appointment-mail">{{ $calendarAppointment->cliente_correo }}</span>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    @if ($rescheduleAppointments->isEmpty())
                                        <div class="history-empty" style="margin-top:18px;">No hay citas registradas para esta semana.</div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="workspace-heading">
                                <div>
                                    <h2>Cambiar fecha de la cita</h2>
                                    <p style="margin-top:8px;color:#8aa0be;">Actualiza o elimina esta cita sin salir del modulo.</p>
                                </div>
                                <a href="{{ route('panel', ['section' => 'reagendar', 'panel_key' => $panelSectionKey('reagendar'), 'reschedule_week' => $rescheduleWeekStart->format('Y-m-d'), 'search' => $search]) }}" class="history-filter-button">Regresar al calendario</a>
                            </div>

                            <div class="workspace-table-shell">
                                <div class="workspace-table-toolbar">
                                    <strong style="color:#5a6f90;">Datos de la cita</strong>
                                </div>
                                <div style="padding:22px;">
                                    <form id="rescheduleAppointmentForm" action="{{ route('panel.reagendar.update', $selectedRescheduleAppointment) }}" method="POST" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
                                        @csrf
                                        <div>
                                            <label style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Cliente</label>
                                            <input type="text" value="{{ $selectedRescheduleAppointment->cliente_nombre }}" readonly style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f3f7fd;color:#4f6483;outline:none;">
                                        </div>
                                        <div>
                                            <label style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Correo</label>
                                            <input type="text" value="{{ $selectedRescheduleAppointment->cliente_correo }}" readonly style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f3f7fd;color:#4f6483;outline:none;">
                                        </div>
                                        <div>
                                            <label style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Fecha actual</label>
                                            <input type="text" value="{{ $selectedRescheduleAppointment->appointment_at->format('d/m/Y H:i') }}" readonly style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f3f7fd;color:#4f6483;outline:none;">
                                        </div>
                                        <div>
                                            <label for="reschedule_appointment_at" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Nueva fecha y hora</label>
                                            <input id="reschedule_appointment_at" name="reschedule_appointment_at" type="datetime-local" min="{{ now()->format('Y-m-d\TH:i') }}" value="{{ old('reschedule_appointment_at', $selectedRescheduleAppointment->appointment_at->format('Y-m-d\TH:i')) }}" required style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        </div>
                                    </form>
                                    <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:18px;flex-wrap:wrap;">
                                        <a href="{{ route('panel', ['section' => 'reagendar', 'panel_key' => $panelSectionKey('reagendar'), 'reschedule_week' => $rescheduleWeekStart->format('Y-m-d'), 'search' => $search]) }}" class="history-filter-button">Regresar al calendario</a>
                                        <form action="{{ route('panel.reagendar.destroy', $selectedRescheduleAppointment) }}" method="POST" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border:none;background:#c51646;color:white;padding:12px 20px;border-radius:12px;font-weight:bold;cursor:pointer;">Eliminar cita</button>
                                        </form>
                                        <button type="submit" form="rescheduleAppointmentForm" style="border:none;background:#17a5ff;color:white;padding:12px 20px;border-radius:12px;font-weight:bold;cursor:pointer;">Guardar nueva fecha</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="workspace-shell panel-section {{ $activeSection === 'notificaciones' ? 'is-active' : '' }}" data-panel-section="notificaciones">
                    <div class="workspace-topbar">
                        <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                            <input type="hidden" name="section" value="notificaciones">
                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('notificaciones') }}">
                            <span>⌕</span>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar cita por cliente o correo">
                            <button type="submit">Buscar</button>
                        </form>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        @if (session('success_notificaciones'))
                            <div class="modules-panel-badge" style="display:inline-flex;margin-bottom:18px;">
                                {{ session('success_notificaciones') }}
                            </div>
                        @endif

                        <div class="workspace-heading">
                            <div>
                                <h2>Notificaciones</h2>
                                <p style="margin-top:8px;color:#8aa0be;">Citas pendientes del dia {{ $agendaToday->format('d/m/Y') }} para enviar recordatorio.</p>
                            </div>
                            <form action="{{ route('panel.notificaciones.send') }}" method="POST">
                                @csrf
                                <input type="hidden" name="search" value="{{ $search ?? '' }}">
                                <button type="submit" style="border:none;background:#17a5ff;color:white;padding:12px 20px;border-radius:12px;font-weight:bold;cursor:pointer;">Notificar</button>
                            </form>
                        </div>

                        <div class="workspace-table-shell">
                            <div class="workspace-table-toolbar">
                                <strong style="color:#5a6f90;">Citas del dia para notificar</strong>
                            </div>
                            <div style="padding:0 22px 22px;">
                                <div class="workspace-table-wrap">
                                    <table class="workspace-table">
                                        <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Correo</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Origen</th>
                                                <th>Creada por</th>
                                            </tr>
                                        </thead>
                                        <tbody id="notificationsTableBody">
                                            @forelse ($notificationAppointments as $notificationAppointment)
                                                <tr data-notification-appointment-row data-notification-appointment-id="{{ $notificationAppointment->id }}">
                                                    <td>{{ $notificationAppointment->cliente_nombre }}</td>
                                                    <td>{{ $notificationAppointment->cliente_correo }}</td>
                                                    <td>{{ $notificationAppointment->appointment_at->format('d/m/Y') }}</td>
                                                    <td>{{ $notificationAppointment->appointment_at->format('H:i') }}</td>
                                                    <td>{{ $notificationAppointment->usariosapp_id ? 'Cliente registrado' : 'Cliente nuevo' }}</td>
                                                    <td>{{ $notificationAppointment->creator?->name ?? 'Sistema' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" style="text-align:center;">No hay citas pendientes del dia para notificar.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="workspace-shell panel-section {{ $activeSection === 'facturacion' ? 'is-active' : '' }}" data-panel-section="facturacion">
                    <div class="workspace-topbar">
                        <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                            <input type="hidden" name="section" value="facturacion">
                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('facturacion') }}">
                            <span>⌕</span>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar cliente para facturar">
                            <button type="submit">Buscar</button>
                        </form>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        @if ($errors->any() && $activeSection === 'facturacion')
                            <div style="margin-bottom:16px;padding:12px 14px;border-radius:12px;background:rgba(255,92,131,0.12);color:#d95b7d;border:1px solid rgba(255,92,131,0.18);">
                                <ul style="margin:0;padding-left:18px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="workspace-heading">
                            <div>
                                <h2>Facturacion</h2>
                                <p style="margin-top:8px;color:#8aa0be;">Calcula la cita, agrega compras extra y descarga la factura en PDF.</p>
                            </div>
                        </div>

                        <div style="display:grid;grid-template-columns:minmax(0,1.1fr) minmax(320px,0.9fr);gap:20px;">
                            <div class="workspace-table-shell">
                                <div class="workspace-table-toolbar">
                                    <strong style="color:#5a6f90;">Nueva factura</strong>
                                </div>
                                <div style="padding:22px;">
                                    @php
                                        $billingClientType = old('billing_client_type', 'existente');
                                        $billingExtras = old('extras', [['descripcion' => '', 'monto' => '']]);
                                    @endphp
                                    <form action="{{ route('panel.facturacion.pdf') }}" method="POST" id="billingForm" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;">
                                        @csrf
                                        <div style="grid-column:1 / -1;">
                                            <label style="display:block;margin-bottom:10px;color:#5a6f90;font-weight:bold;">Tipo de cliente</label>
                                            <div style="display:flex;gap:18px;flex-wrap:wrap;">
                                                <label style="display:inline-flex;align-items:center;gap:8px;color:#4f6483;font-weight:600;">
                                                    <input type="radio" name="billing_client_type" value="existente" {{ $billingClientType === 'existente' ? 'checked' : '' }} data-billing-type>
                                                    <span>Cliente registrado</span>
                                                </label>
                                                <label style="display:inline-flex;align-items:center;gap:8px;color:#4f6483;font-weight:600;">
                                                    <input type="radio" name="billing_client_type" value="nuevo" {{ $billingClientType === 'nuevo' ? 'checked' : '' }} data-billing-type>
                                                    <span>Cliente nuevo</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div id="billingExistingFields" style="grid-column:1 / -1;display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;{{ $billingClientType === 'nuevo' ? 'display:none;' : '' }}">
                                            <input id="billing_usariosapp_id" name="billing_usariosapp_id" type="hidden" value="{{ old('billing_usariosapp_id') }}">
                                            <div>
                                                <label for="billing_existing_nombre" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Nombre del cliente</label>
                                                <input id="billing_existing_nombre" type="text" value="{{ old('billing_usariosapp_id') ? optional($agendaClients->firstWhere('id', (int) old('billing_usariosapp_id')))->nombre : '' }}" placeholder="Haz clic en un cliente disponible" readonly style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f3f7fd;color:#4f6483;outline:none;">
                                            </div>
                                            <div>
                                                <label for="billing_existing_correo" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Correo del cliente</label>
                                                <input id="billing_existing_correo" type="email" value="{{ old('billing_usariosapp_id') ? optional($agendaClients->firstWhere('id', (int) old('billing_usariosapp_id')))->correo : '' }}" placeholder="Se llenara al hacer clic en un cliente" readonly style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f3f7fd;color:#4f6483;outline:none;">
                                            </div>
                                        </div>

                                        <div id="billingNewNameField" style="{{ $billingClientType === 'existente' ? 'display:none;' : '' }}">
                                            <label for="billing_cliente_nombre" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Nombre del cliente</label>
                                            <input id="billing_cliente_nombre" name="billing_cliente_nombre" type="text" value="{{ old('billing_cliente_nombre') }}" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        </div>

                                        <div id="billingNewEmailField" style="{{ $billingClientType === 'existente' ? 'display:none;' : '' }}">
                                            <label for="billing_cliente_correo" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Correo del cliente</label>
                                            <input id="billing_cliente_correo" name="billing_cliente_correo" type="email" value="{{ old('billing_cliente_correo') }}" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        </div>

                                        <div>
                                            <label for="cita_costo" style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Costo de la cita</label>
                                            <input id="cita_costo" name="cita_costo" type="number" min="0" step="0.01" value="{{ old('cita_costo', '0.00') }}" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                        </div>

                                        <div style="display:flex;align-items:flex-end;">
                                            <div style="width:100%;padding:14px 16px;border-radius:14px;border:1px solid rgba(23,165,255,0.25);background:rgba(23,165,255,0.08);">
                                                <div style="font-size:0.85rem;color:#8aa0be;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;">Total actual</div>
                                                <div id="billingTotalDisplay" style="margin-top:8px;font-size:1.8rem;font-weight:800;color:#d8e9ff;">Q 0.00</div>
                                            </div>
                                        </div>

                                        <div style="grid-column:1 / -1;">
                                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                                                <label style="color:#5a6f90;font-weight:bold;">Compras adicionales</label>
                                                <button type="button" id="addBillingExtraButton" class="history-filter-button">Agregar compra</button>
                                            </div>
                                            <div id="billingExtrasList" style="display:grid;gap:12px;">
                                                @foreach ($billingExtras as $index => $billingExtra)
                                                    <div class="billing-extra-row" style="display:grid;grid-template-columns:minmax(0,1.4fr) minmax(140px,0.6fr) auto;gap:12px;align-items:end;">
                                                        <div>
                                                            <label style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Descripcion</label>
                                                            <input type="text" name="extras[{{ $index }}][descripcion]" value="{{ $billingExtra['descripcion'] ?? '' }}" placeholder="Ej. Proteina, vitaminas, consulta extra" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                                        </div>
                                                        <div>
                                                            <label style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Monto</label>
                                                            <input type="number" min="0" step="0.01" name="extras[{{ $index }}][monto]" value="{{ $billingExtra['monto'] ?? '' }}" placeholder="0.00" data-billing-extra-amount style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                                                        </div>
                                                        <button type="button" class="delete-button-outline billing-remove-extra" style="height:48px;">Quitar</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div style="grid-column:1 / -1;display:flex;justify-content:flex-end;">
                                            <button type="submit" id="billingSubmitButton" style="border:none;background:#17a5ff;color:white;padding:12px 20px;border-radius:12px;font-weight:bold;cursor:pointer;">Finalizar y descargar PDF</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="workspace-table-shell">
                                <div class="workspace-table-toolbar">
                                    <strong style="color:#5a6f90;">Clientes disponibles</strong>
                                </div>
                                <div style="padding:22px;display:grid;gap:12px;max-height:620px;overflow:auto;">
                                    <div class="workspace-table-search" style="margin-bottom:6px;">
                                        <span>⌕</span>
                                        <input type="text" id="billingClientSearch" placeholder="Buscar cliente en tiempo real">
                                    </div>

                                    @forelse ($agendaClients as $billingClient)
                                        <button
                                            type="button"
                                            class="history-user-link"
                                            style="cursor:pointer;text-align:left;background:transparent;width:100%;"
                                            data-billing-client-card
                                            data-billing-client-text="{{ strtolower($billingClient->nombre . ' ' . $billingClient->correo . ' ' . ($billingClient->dpi ?? '')) }}"
                                            data-billing-client-id="{{ $billingClient->id }}"
                                            data-billing-client-nombre="{{ $billingClient->nombre }}"
                                            data-billing-client-correo="{{ $billingClient->correo }}"
                                        >
                                            <div class="workspace-avatar">{{ strtoupper(substr($billingClient->nombre, 0, 1)) }}</div>
                                            <div class="history-user-meta">
                                                <strong>{{ $billingClient->nombre }}</strong>
                                                <span>{{ $billingClient->correo }}</span>
                                            </div>
                                        </button>
                                    @empty
                                        <div class="history-empty">Todavia no hay clientes registrados para facturar.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="workspace-shell panel-section {{ $activeSection === 'auditoria' ? 'is-active' : '' }}" data-panel-section="auditoria">
                    <div class="workspace-topbar">
                        <form action="{{ route('panel') }}" method="GET" class="workspace-search">
                            <input type="hidden" name="section" value="auditoria">
                            <input type="hidden" name="panel_key" value="{{ $panelSectionKey('auditoria') }}">
                            <input type="hidden" name="audit_view" value="{{ $auditView }}">
                            @if ($auditDate !== '')
                                <input type="hidden" name="audit_date" value="{{ $auditDate }}">
                            @endif
                            <span>⌕</span>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar factura por cliente o correo">
                            <button type="submit">Buscar</button>
                        </form>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        @if (session('success_auditoria'))
                            <div class="modules-panel-badge" style="display:inline-flex;margin-bottom:18px;">
                                {{ session('success_auditoria') }}
                            </div>
                        @endif

                        <div class="workspace-heading">
                            <div>
                                <h2>Auditoria</h2>
                                <p style="margin-top:8px;color:#8aa0be;">
                                    @if ($auditView === 'historial')
                                        Historial de auditoria{{ $auditDate !== '' ? ' del ' . $auditSelectedDate->format('d/m/Y') : '' }}.
                                    @else
                                        Facturas del dia {{ $agendaToday->format('d/m/Y') }} en horario de Guatemala.
                                    @endif
                                </p>
                            </div>
                            <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                                @if ($auditView === 'historial')
                                    <a href="{{ route('panel', ['section' => 'auditoria', 'panel_key' => $panelSectionKey('auditoria'), 'search' => $search]) }}" class="history-filter-button">Hoy</a>
                                @else
                                    <a href="{{ route('panel', ['section' => 'auditoria', 'panel_key' => $panelSectionKey('auditoria'), 'audit_view' => 'historial', 'search' => $search]) }}" class="history-filter-button">Historial de auditoria</a>
                                @endif
                                <form action="{{ route('panel.auditoria.corte') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="border:none;background:#17a5ff;color:white;padding:12px 20px;border-radius:12px;font-weight:bold;cursor:pointer;">Corte de caja</button>
                                </form>
                            </div>
                        </div>

                        @if ($auditView === 'historial')
                            <div class="workspace-table-shell" style="margin-bottom:20px;">
                                <div class="workspace-table-toolbar">
                                    <strong style="color:#5a6f90;">Buscar historial por fecha</strong>
                                </div>
                                <div style="padding:0 22px 22px;display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                                    <form action="{{ route('panel') }}" method="GET" class="history-date-form" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                                        <input type="hidden" name="section" value="auditoria">
                                        <input type="hidden" name="panel_key" value="{{ $panelSectionKey('auditoria') }}">
                                        <input type="hidden" name="audit_view" value="historial">
                                        @if ($search !== '')
                                            <input type="hidden" name="search" value="{{ $search }}">
                                        @endif
                                        <input type="date" name="audit_date" value="{{ $auditDate }}" id="auditDateFilterInput">
                                        <button type="submit">Filtrar fecha</button>
                                    </form>
                                    <form action="{{ route('panel.auditoria.corte.fecha') }}" method="POST" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;margin:0;">
                                        @csrf
                                        <input type="hidden" name="audit_date" value="{{ $auditDate }}" id="auditDateCutInput">
                                        <button type="submit" class="history-filter-button">Corte de fecha seleccionada</button>
                                    </form>
                                    @if ($auditDate !== '')
                                        <a href="{{ route('panel', ['section' => 'auditoria', 'panel_key' => $panelSectionKey('auditoria'), 'audit_view' => 'historial', 'search' => $search]) }}" class="history-date-clear">Limpiar</a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;margin-bottom:20px;">
                            <div class="workspace-table-shell">
                                <div style="padding:18px 20px;">
                                    <div style="font-size:0.82rem;color:#8aa0be;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;">Total desde ultimo corte</div>
                                    <div id="billingCutTotalValue" style="margin-top:10px;font-size:2rem;font-weight:800;color:#d8e9ff;">Q {{ number_format($billingCutTotal, 2) }}</div>
                                </div>
                            </div>
                            <div class="workspace-table-shell">
                                <div style="padding:18px 20px;">
                                    <div style="font-size:0.82rem;color:#8aa0be;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;">Clientes facturados</div>
                                    <div id="billingCutClientCountValue" style="margin-top:10px;font-size:2rem;font-weight:800;color:#d8e9ff;">{{ $billingCutClientCount }}</div>
                                </div>
                            </div>
                            <div class="workspace-table-shell">
                                <div style="padding:18px 20px;">
                                    <div style="font-size:0.82rem;color:#8aa0be;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;">Ultimo corte</div>
                                    <div style="margin-top:10px;font-size:1.05rem;font-weight:800;color:#d8e9ff;">{{ $lastCashCut ? $lastCashCut->cut_at->format('d/m/Y H:i') : 'No realizado' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="workspace-table-shell">
                            <div class="workspace-table-toolbar">
                                <strong style="color:#5a6f90;">{{ $auditView === 'historial' ? 'Historial de auditoria' : 'Facturas del dia' }}</strong>
                            </div>
                            <div style="padding:0 22px 22px;">
                                <div class="workspace-table-wrap">
                                    <table class="workspace-table">
                                        <thead>
                                            <tr>
                                                <th>Factura</th>
                                                <th>Cliente</th>
                                                <th>Correo</th>
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody id="billingAuditTableBody" data-audit-view="{{ $auditView }}" data-audit-date="{{ $auditDate !== '' ? $auditSelectedDate->format('Y-m-d') : '' }}" data-audit-today="{{ $agendaToday->format('Y-m-d') }}">
                                            @forelse ($billingInvoices as $billingInvoice)
                                                <tr data-billing-audit-row data-billing-invoice-id="{{ $billingInvoice->id }}">
                                                    <td>{{ $billingInvoice->invoice_number }}</td>
                                                    <td>{{ $billingInvoice->cliente_nombre }}</td>
                                                    <td>{{ $billingInvoice->cliente_correo }}</td>
                                                    <td>{{ $billingInvoice->billed_at->format('d/m/Y H:i') }}</td>
                                                    <td>Q {{ number_format($billingInvoice->total, 2) }}</td>
                                                    <td>
                                                        <div>Cita: Q {{ number_format($billingInvoice->cita_costo, 2) }}</div>
                                                        @php
                                                            $invoiceExtras = collect($billingInvoice->extras ?? []);
                                                        @endphp
                                                        @if ($invoiceExtras->isEmpty())
                                                            <div>Sin compras extra</div>
                                                        @else
                                                            @foreach ($invoiceExtras as $invoiceExtra)
                                                                <div>{{ $invoiceExtra['descripcion'] ?: 'Compra adicional' }} - Q {{ number_format((float) ($invoiceExtra['monto'] ?? 0), 2) }}</div>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" style="text-align:center;">
                                                        @if ($auditView === 'historial' && $auditDate !== '')
                                                            No hay facturas registradas en la fecha seleccionada.
                                                        @elseif ($auditView === 'historial')
                                                            Todavia no hay facturas registradas.
                                                        @else
                                                            No hay facturas registradas para hoy.
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="workspace-shell panel-section {{ $activeSection === 'seguridad' ? 'is-active' : '' }}" data-panel-section="seguridad">
                    <div class="workspace-topbar">
                        <div class="workspace-search" style="display:flex;align-items:center;">
                            <span>⌕</span>
                            <input type="text" value="{{ $securityView === 'historial' ? 'Historial completo de inicios de sesion' : 'Registro diario de inicios de sesion' }}" readonly>
                        </div>

                        <div class="workspace-user">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <div class="workspace-body">
                        <div class="workspace-heading">
                            <div>
                                <h2>Seguridad</h2>
                                <p style="margin-top:8px;color:#8aa0be;">
                                    {{ $securityView === 'historial' ? 'Historial completo ordenado por fecha y hora.' : 'Inicios de sesion del dia ' . $agendaToday->format('d/m/Y') . ' en horario de Guatemala.' }}
                                </p>
                            </div>
                            <div style="display:flex;gap:12px;align-items:center;">
                                @if ($securityView === 'historial')
                                    <a href="{{ route('panel', ['section' => 'seguridad', 'panel_key' => $panelSectionKey('seguridad')]) }}" class="history-filter-button">Hoy</a>
                                @else
                                    <a href="{{ route('panel', ['section' => 'seguridad', 'panel_key' => $panelSectionKey('seguridad'), 'security_view' => 'historial']) }}" class="history-filter-button">Historial</a>
                                @endif
                            </div>
                        </div>

                        <div class="workspace-table-shell">
                            <div class="workspace-table-toolbar">
                                <strong style="color:#5a6f90;">{{ $securityView === 'historial' ? 'Historial de inicios de sesion' : 'Inicios de sesion del dia' }}</strong>
                            </div>
                            <div style="padding:0 22px 22px;">
                                <div class="workspace-table-wrap">
                                    <table class="workspace-table">
                                        <thead>
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Correo</th>
                                                <th>Dia</th>
                                                <th>Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($securityLogins as $login)
                                                <tr>
                                                    <td>{{ $login->user_name ?? 'Usuario eliminado' }}</td>
                                                    <td>{{ $login->user_email ?? 'Sin correo' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($login->created_at)->format('d/m/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($login->created_at)->format('H:i') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" style="text-align:center;">Aun no hay inicios de sesion registrados.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <div class="single-tab-overlay" id="singleTabOverlay" aria-hidden="true">
        <div class="single-tab-card" role="dialog" aria-modal="true" aria-labelledby="singleTabMessage">
            <p id="singleTabMessage">Nutri Glow Admin esta abierto en otra ventana. Haz clic en "Usar aqui" para abrir Nutri Glow Admin en esta ventana.</p>
            <div class="single-tab-actions">
                <button type="button" class="single-tab-close" id="singleTabClose">Cerrar</button>
                <button type="button" class="single-tab-use" id="singleTabUseHere">Usar aqui</button>
            </div>
        </div>
    </div>
    <div class="floating-toast" id="floatingToast" role="status" aria-live="polite"></div>
    <div class="confirm-overlay" id="deleteConfirmOverlay" aria-hidden="true">
        <div class="confirm-card" role="dialog" aria-modal="true" aria-labelledby="deleteConfirmTitle">
            <h3 id="deleteConfirmTitle">Eliminar usuario</h3>
            <p id="deleteConfirmText">Esta accion quitara el usuario seleccionado del sistema. Puedes cancelar si no deseas continuar.</p>
            <div class="confirm-actions">
                <button type="button" class="confirm-cancel" id="cancelDeleteUser">Cancelar</button>
                <button type="button" class="confirm-delete" id="confirmDeleteUser">Eliminar</button>
            </div>
        </div>
    </div>
    <script>
        (() => {
            const themeToggle = document.getElementById('themeToggle');
            const themeToggleText = document.getElementById('themeToggleText');
            const storageKey = 'nutriglow_panel_theme';

            const applyTheme = (theme) => {
                const isLight = theme === 'light';
                document.body.classList.toggle('light-mode', isLight);

                if (themeToggle) {
                    themeToggle.setAttribute('aria-pressed', isLight ? 'true' : 'false');
                }

                if (themeToggleText) {
                    themeToggleText.textContent = isLight ? 'Modo oscuro' : 'Modo claro';
                }
            };

            let savedTheme = 'dark';

            try {
                savedTheme = localStorage.getItem(storageKey) === 'light' ? 'light' : 'dark';
            } catch (error) {
                savedTheme = document.body.classList.contains('light-mode') ? 'light' : 'dark';
            }

            applyTheme(savedTheme);

            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const nextTheme = document.body.classList.contains('light-mode') ? 'dark' : 'light';

                    try {
                        localStorage.setItem(storageKey, nextTheme);
                    } catch (error) {
                        // Si no se puede guardar, al menos cambiamos el tema de esta pestaña.
                    }

                    applyTheme(nextTheme);
                });
            }
        })();

        (() => {
            const overlay = document.getElementById('singleTabOverlay');
            const useHereButton = document.getElementById('singleTabUseHere');
            const closeButton = document.getElementById('singleTabClose');

            if (!overlay || !useHereButton || !closeButton) {
                return;
            }

            const channelName = 'nutriglow-panel-single-tab';
            const storageSignalKey = 'nutriglow_panel_tab_signal';
            const storageOwnerKey = 'nutriglow_panel_tab_owner';
            const reauthFlagKey = 'nutriglow_panel_single_tab_reauth';
            const securityLoginUrl = @json(route('login.security'));
            const tabId = `${Date.now()}-${Math.random().toString(36).slice(2)}`;
            let isActiveTab = false;
            let activeTabFound = false;
            let channel = null;

            const showSingleTabWarning = () => {
                isActiveTab = false;
                overlay.classList.add('is-visible');
                overlay.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            const hideSingleTabWarning = () => {
                overlay.classList.remove('is-visible');
                overlay.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            const goToSecurityLogin = (needsReauth = false) => {
                const url = new URL(securityLoginUrl, window.location.origin);

                if (needsReauth) {
                    url.searchParams.set('single_tab', '1');
                }

                window.location.replace(url.toString());
            };

            const isReauthenticatedDuplicate = () => {
                try {
                    return sessionStorage.getItem(reauthFlagKey) === '1';
                } catch (error) {
                    return false;
                }
            };

            const broadcastSingleTabMessage = (message) => {
                const payload = {
                    ...message,
                    tabId,
                    sentAt: Date.now(),
                };

                if (channel) {
                    channel.postMessage(payload);
                }

                try {
                    localStorage.setItem(storageSignalKey, JSON.stringify(payload));
                } catch (error) {
                    // Si el navegador bloquea localStorage, BroadcastChannel sigue cubriendo el caso normal.
                }
            };

            const claimThisTab = () => {
                isActiveTab = true;
                activeTabFound = true;
                hideSingleTabWarning();

                try {
                    sessionStorage.removeItem(reauthFlagKey);
                } catch (error) {
                    // No bloqueamos el panel si sessionStorage no esta disponible.
                }

                try {
                    localStorage.setItem(storageOwnerKey, JSON.stringify({
                        tabId,
                        updatedAt: Date.now(),
                    }));
                } catch (error) {
                    // No bloqueamos el panel si el navegador no permite guardar estado local.
                }

                broadcastSingleTabMessage({ type: 'claim' });
            };

            const handleSingleTabMessage = (message) => {
                if (!message || message.tabId === tabId) {
                    return;
                }

                if (message.type === 'hello' && isActiveTab) {
                    broadcastSingleTabMessage({ type: 'active' });
                    return;
                }

                if (message.type === 'active' && !isActiveTab) {
                    activeTabFound = true;
                    if (isReauthenticatedDuplicate()) {
                        showSingleTabWarning();
                    } else {
                        goToSecurityLogin(true);
                    }
                    return;
                }

                if (message.type === 'claim') {
                    goToSecurityLogin();
                }
            };

            if ('BroadcastChannel' in window) {
                channel = new BroadcastChannel(channelName);
                channel.addEventListener('message', (event) => {
                    handleSingleTabMessage(event.data);
                });
            }

            window.addEventListener('storage', (event) => {
                if (event.key !== storageSignalKey || !event.newValue) {
                    return;
                }

                try {
                    handleSingleTabMessage(JSON.parse(event.newValue));
                } catch (error) {
                    // Ignoramos senales locales incompletas.
                }
            });

            useHereButton.addEventListener('click', claimThisTab);
            closeButton.addEventListener('click', () => {
                window.close();
                goToSecurityLogin();
            });

            broadcastSingleTabMessage({ type: 'hello' });

            window.setTimeout(() => {
                if (activeTabFound) {
                    if (isReauthenticatedDuplicate()) {
                        showSingleTabWarning();
                    } else {
                        goToSecurityLogin(true);
                    }
                    return;
                }

                claimThisTab();
            }, 450);

            window.setInterval(() => {
                if (!isActiveTab) {
                    return;
                }

                try {
                    localStorage.setItem(storageOwnerKey, JSON.stringify({
                        tabId,
                        updatedAt: Date.now(),
                    }));
                } catch (error) {
                    // Mantener silencioso: no afecta el uso del panel.
                }
            }, 5000);

            window.addEventListener('beforeunload', () => {
                if (!isActiveTab) {
                    return;
                }

                try {
                    const owner = JSON.parse(localStorage.getItem(storageOwnerKey) || '{}');

                    if (owner.tabId === tabId) {
                        localStorage.removeItem(storageOwnerKey);
                    }
                } catch (error) {
                    // No es necesario hacer nada si el estado local no esta disponible.
                }
            });
        })();

        (() => {
            const inactivityLimit = 45 * 60 * 1000;
            const logoutUrl = @json(route('logout'));
            const loginUrl = @json(route('login'));
            const token = @json(csrf_token());
            let inactivityTimer = null;
            let lastMouseReset = 0;
            let isLoggingOut = false;

            const logoutForInactivity = async () => {
                if (isLoggingOut) {
                    return;
                }

                isLoggingOut = true;

                try {
                    await fetch(logoutUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest',
                            Accept: 'text/html,application/xhtml+xml',
                        },
                        credentials: 'same-origin',
                    });
                } catch (error) {
                    // Si la peticion falla, igual sacamos al usuario del panel visualmente.
                } finally {
                    window.location.replace(loginUrl);
                }
            };

            const resetInactivityTimer = () => {
                if (isLoggingOut) {
                    return;
                }

                window.clearTimeout(inactivityTimer);
                inactivityTimer = window.setTimeout(logoutForInactivity, inactivityLimit);
            };

            ['click', 'keydown', 'input', 'change', 'scroll', 'touchstart', 'pointerdown'].forEach((eventName) => {
                window.addEventListener(eventName, resetInactivityTimer, { passive: true });
            });

            window.addEventListener('mousemove', () => {
                const now = Date.now();

                if (now - lastMouseReset < 3000) {
                    return;
                }

                lastMouseReset = now;
                resetInactivityTimer();
            }, { passive: true });

            resetInactivityTimer();
        })();

        const toggleCargaForm = document.getElementById('toggleCargaForm');
        const cargaFormBox = document.getElementById('cargaFormBox');
        const cargasListBox = document.getElementById('cargasListBox');
        const backCargaList = document.getElementById('backCargaList');
        const cargaUserForm = document.getElementById('cargaUserForm');
        const cargaFormTitle = document.getElementById('cargaFormTitle');
        const cargaSubmitButton = document.getElementById('cargaSubmitButton');
        const cargaEditingIdInput = document.getElementById('carga_editing_id');
        const cargaNombreInput = document.getElementById('nombre');
        const cargaCorreoInput = document.getElementById('correo');
        const cargaDpiInput = document.getElementById('dpi');
        const cargaPasswordInput = document.getElementById('password');
        const toggleCargaPassword = document.getElementById('toggleCargaPassword');
        const toggleSystemUserForm = document.getElementById('toggleSystemUserForm');
        const systemUserFormBox = document.getElementById('systemUserFormBox');
        const systemUsersListBox = document.getElementById('systemUsersListBox');
        const backSystemUserList = document.getElementById('backSystemUserList');
        const systemUserForm = document.querySelector('[data-system-user-form]');
        const systemUserFormTitle = document.getElementById('systemUserFormTitle');
        const systemUserSubmitButton = document.getElementById('systemUserSubmitButton');
        const systemUsersTableBody = document.getElementById('systemUsersTableBody');
        const systemNameInput = document.getElementById('system_name');
        const systemEmailInput = document.getElementById('system_email');
        const systemCurrentPasswordField = document.getElementById('systemCurrentPasswordField');
        const systemCurrentPasswordInput = document.getElementById('system_current_password');
        const systemPasswordInput = document.getElementById('system_password');
        const systemPasswordLabel = document.getElementById('systemPasswordLabel') || document.querySelector('label[for="system_password"]');
        const toggleSystemPassword = document.getElementById('toggleSystemPassword');
        const goToAdminResetLink = document.getElementById('goToAdminResetLink');
        const systemRoleInput = document.getElementById('system_role');
        const adminResetBox = document.getElementById('adminResetBox');
        const adminResetHelp = adminResetBox?.querySelector('.admin-reset-help');
        const adminVerificationCodeInput = document.getElementById('admin_verification_code');
        const sendAdminCodeButton = document.getElementById('sendAdminCodeButton');
        const confirmAdminCodeButton = document.getElementById('confirmAdminCodeButton');
        const passwordCheckLabel = toggleSystemPassword?.closest('.password-check');
        const systemFormFields = systemUserForm ? systemUserForm.querySelectorAll('input, select') : [];
        const passwordHintItems = document.querySelectorAll('[data-password-rule]');
        const floatingToast = document.getElementById('floatingToast');
        const deleteConfirmOverlay = document.getElementById('deleteConfirmOverlay');
        const deleteConfirmTitle = document.getElementById('deleteConfirmTitle');
        const deleteConfirmText = document.getElementById('deleteConfirmText');
        const cancelDeleteUser = document.getElementById('cancelDeleteUser');
        const confirmDeleteUser = document.getElementById('confirmDeleteUser');
        let pendingDeleteRow = null;
        let pendingDeleteConfig = null;
        let adminRecoveryMode = false;
        const searchInputs = document.querySelectorAll('input[name="search"]');
        const searchRows = document.querySelectorAll('[data-search-row]');
        const systemUserRows = document.querySelectorAll('[data-system-user-row]');
        const detailTriggers = document.querySelectorAll('.workspace-user-trigger');
        const detailBox = document.getElementById('workspaceDetail');
        const detailUserId = document.getElementById('detailUserId');
        const detailUserNombre = document.getElementById('detailUserNombre');
        const detailUserCorreo = document.getElementById('detailUserCorreo');
        const detailUserDpi = document.getElementById('detailUserDpi');
        const cargasTableBody = document.getElementById('cargasTableBody');
        const historyUserSearch = document.getElementById('historyUserSearch');
        const historyUserList = document.getElementById('historyUserList');
        const historyUserLinks = document.querySelectorAll('[data-history-user]');
        const historyDayTriggers = document.querySelectorAll('[data-history-day]');
        const historyDaysShell = document.getElementById('historyDaysShell');
        const historyDayDetail = document.getElementById('historyDayDetail');
        const historyBackButton = document.getElementById('historyBackButton');
        const historyDetailDate = document.getElementById('historyDetailDate');
        const historyDetailTitulo = document.getElementById('historyDetailTitulo');
        const historyDetailCalorias = document.getElementById('historyDetailCalorias');
        const historyDetailCarbohidratos = document.getElementById('historyDetailCarbohidratos');
        const historyDetailProteina = document.getElementById('historyDetailProteina');
        const historyDetailGrasas = document.getElementById('historyDetailGrasas');
        const recipeSearchInput = document.getElementById('recipeSearchInput');
        const recipeRows = document.querySelectorAll('[data-recipe-row]');
        const recipeListToolbar = document.getElementById('recipeListToolbar');
        const recipeListShell = document.getElementById('recipeListShell');
        const recipeOpenLinks = document.querySelectorAll('[data-recipe-open]');
        const recipeBackLinks = document.querySelectorAll('[data-recipe-back]');
        const recipeDetailPanels = document.querySelectorAll('[data-recipe-detail]');
        const recipeRangeSelects = document.querySelectorAll('[data-recipe-range-select]');
        const recipeForms = document.querySelectorAll('[data-recipe-form]');
        const agendaTypeInputs = document.querySelectorAll('[data-agenda-type]');
        const agendaExistingFields = document.getElementById('agendaExistingFields');
        const agendaNewNameField = document.getElementById('agendaNewNameField');
        const agendaNewEmailField = document.getElementById('agendaNewEmailField');
        const agendaExistingSelect = document.getElementById('agenda_usariosapp_id');
        const agendaExistingNameInput = document.getElementById('agenda_existing_nombre');
        const agendaExistingEmailInput = document.getElementById('agenda_existing_correo');
        const agendaNewNameInput = document.getElementById('agenda_cliente_nombre');
        const agendaNewEmailInput = document.getElementById('agenda_cliente_correo');
        const agendaClientSearch = document.getElementById('agendaClientSearch');
        const agendaClientCards = document.querySelectorAll('[data-agenda-client-card]');
        const billingTypeInputs = document.querySelectorAll('[data-billing-type]');
        const billingExistingFields = document.getElementById('billingExistingFields');
        const billingNewNameField = document.getElementById('billingNewNameField');
        const billingNewEmailField = document.getElementById('billingNewEmailField');
        const billingExistingIdInput = document.getElementById('billing_usariosapp_id');
        const billingExistingNameInput = document.getElementById('billing_existing_nombre');
        const billingExistingEmailInput = document.getElementById('billing_existing_correo');
        const billingNewNameInput = document.getElementById('billing_cliente_nombre');
        const billingNewEmailInput = document.getElementById('billing_cliente_correo');
        const billingClientSearch = document.getElementById('billingClientSearch');
        const billingClientCards = document.querySelectorAll('[data-billing-client-card]');
        const billingCostInput = document.getElementById('cita_costo');
        const billingTotalDisplay = document.getElementById('billingTotalDisplay');
        const billingExtrasList = document.getElementById('billingExtrasList');
        const addBillingExtraButton = document.getElementById('addBillingExtraButton');
        const billingForm = document.getElementById('billingForm');
        const billingSubmitButton = document.getElementById('billingSubmitButton');
        const billingAuditTableBody = document.getElementById('billingAuditTableBody');
        const auditDateFilterInput = document.getElementById('auditDateFilterInput');
        const auditDateCutInput = document.getElementById('auditDateCutInput');
        const billingCutTotalValue = document.getElementById('billingCutTotalValue');
        const billingCutClientCountValue = document.getElementById('billingCutClientCountValue');
        const agendaPendingTableBody = document.getElementById('agendaPendingTableBody');
        const agendaCompletedTableBody = document.getElementById('agendaCompletedTableBody');
        const notificationsTableBody = document.getElementById('notificationsTableBody');
        const cargaDeleteButtons = document.querySelectorAll('[data-carga-delete-button]');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        let activePanelSection = document.querySelector('[data-panel-section].is-active')?.dataset.panelSection || 'principal';

        function getSelectedBillingType() {
            return Array.from(billingTypeInputs).find((input) => input.checked)?.value || 'existente';
        }

        function updateBillingSubmitState() {
            if (!billingSubmitButton) {
                return;
            }

            const selectedType = getSelectedBillingType();
            const hasExistingClient = selectedType === 'existente'
                ? (billingExistingIdInput?.value || '').trim() !== ''
                    && (billingExistingNameInput?.value || '').trim() !== ''
                    && (billingExistingEmailInput?.value || '').trim() !== ''
                : false;
            const hasNewClient = selectedType === 'nuevo'
                ? (billingNewNameInput?.value || '').trim() !== ''
                    && (billingNewEmailInput?.value || '').trim() !== ''
                : false;
            const isEnabled = selectedType === 'existente' ? hasExistingClient : hasNewClient;

            billingSubmitButton.disabled = !isEnabled;
            billingSubmitButton.style.opacity = isEnabled ? '1' : '0.55';
            billingSubmitButton.style.cursor = isEnabled ? 'pointer' : 'not-allowed';
        }

        function getPanelSectionFromUrl(url) {
            if (url.origin !== window.location.origin || url.pathname !== '{{ parse_url(route('panel'), PHP_URL_PATH) }}') {
                return null;
            }

            return url.searchParams.get('section') || 'principal';
        }

        function activatePanelSection(section, url) {
            const sectionElement = document.querySelector(`[data-panel-section="${section}"]`);

            if (!sectionElement) {
                return false;
            }

            if (activePanelSection === section) {
                if (url && window.location.href !== url.href) {
                    window.history.replaceState({ panelSection: section }, '', url);
                }

                return true;
            }

            document.querySelectorAll('[data-panel-section]').forEach((panelSection) => {
                panelSection.classList.toggle('is-active', panelSection === sectionElement);
            });

            activePanelSection = section;

            document.querySelectorAll('.sidebar-menu .menu-item').forEach((item) => {
                const itemUrl = new URL(item.getAttribute('href') || '#', window.location.href);
                item.classList.toggle('active', getPanelSectionFromUrl(itemUrl) === section);
            });

            if (url && window.location.href !== url.href) {
                window.history.pushState({ panelSection: section }, '', url);
            }

            return true;
        }

        function syncAgendaClientFields() {
            const selectedType = Array.from(agendaTypeInputs).find((input) => input.checked)?.value || 'existente';

            if (!agendaExistingFields || !agendaNewNameField || !agendaNewEmailField) {
                return;
            }

            const usingExisting = selectedType === 'existente';

            agendaExistingFields.style.display = usingExisting ? '' : 'none';
            agendaNewNameField.style.display = usingExisting ? 'none' : '';
            agendaNewEmailField.style.display = usingExisting ? 'none' : '';

            if (agendaExistingSelect) {
                agendaExistingSelect.required = usingExisting;
            }

            if (usingExisting) {
                if (agendaNewNameInput) {
                    agendaNewNameInput.value = '';
                }

                if (agendaNewEmailInput) {
                    agendaNewEmailInput.value = '';
                }
            } else {
                if (agendaExistingSelect) {
                    agendaExistingSelect.value = '';
                }

                if (agendaExistingNameInput) {
                    agendaExistingNameInput.value = '';
                }

                if (agendaExistingEmailInput) {
                    agendaExistingEmailInput.value = '';
                }
            }

            if (agendaNewNameInput) {
                agendaNewNameInput.required = ! usingExisting;
            }

            if (agendaNewEmailInput) {
                agendaNewEmailInput.required = ! usingExisting;
            }
        }

        function filterAgendaClientCards(value) {
            const normalized = value.trim().toLowerCase();

            agendaClientCards.forEach((card) => {
                const text = card.dataset.agendaClientText || '';
                card.style.display = text.includes(normalized) ? '' : 'none';
            });
        }

        function fillAgendaClientFromCard(card) {
            const existenteType = document.querySelector('[data-agenda-type][value="existente"]');

            if (existenteType) {
                existenteType.checked = true;
            }

            syncAgendaClientFields();

            if (agendaExistingSelect) {
                agendaExistingSelect.value = card.dataset.agendaClientId || '';
            }

            if (agendaExistingNameInput) {
                agendaExistingNameInput.value = card.dataset.agendaClientNombre || '';
            }

            if (agendaExistingEmailInput) {
                agendaExistingEmailInput.value = card.dataset.agendaClientCorreo || '';
            }

            agendaExistingNameInput?.focus();
        }

        function syncBillingClientFields() {
            const selectedType = getSelectedBillingType();

            if (!billingExistingFields || !billingNewNameField || !billingNewEmailField) {
                return;
            }

            const usingExisting = selectedType === 'existente';

            billingExistingFields.style.display = usingExisting ? '' : 'none';
            billingNewNameField.style.display = usingExisting ? 'none' : '';
            billingNewEmailField.style.display = usingExisting ? 'none' : '';

            if (billingExistingIdInput) {
                billingExistingIdInput.required = usingExisting;
            }

            if (billingNewNameInput) {
                billingNewNameInput.required = !usingExisting;
            }

            if (billingNewEmailInput) {
                billingNewEmailInput.required = !usingExisting;
            }

            if (usingExisting) {
                if (billingNewNameInput) {
                    billingNewNameInput.value = '';
                }

                if (billingNewEmailInput) {
                    billingNewEmailInput.value = '';
                }
            } else {
                if (billingExistingIdInput) {
                    billingExistingIdInput.value = '';
                }

                if (billingExistingNameInput) {
                    billingExistingNameInput.value = '';
                }

                if (billingExistingEmailInput) {
                    billingExistingEmailInput.value = '';
                }
            }

            updateBillingSubmitState();
        }

        function filterBillingClientCards(value) {
            const normalized = value.trim().toLowerCase();

            billingClientCards.forEach((card) => {
                const text = card.dataset.billingClientText || '';
                card.style.display = text.includes(normalized) ? '' : 'none';
            });
        }

        function fillBillingClientFromCard(card) {
            const existingType = document.querySelector('[data-billing-type][value="existente"]');

            if (existingType) {
                existingType.checked = true;
            }

            syncBillingClientFields();

            if (billingExistingIdInput) {
                billingExistingIdInput.value = card.dataset.billingClientId || '';
            }

            if (billingExistingNameInput) {
                billingExistingNameInput.value = card.dataset.billingClientNombre || '';
            }

            if (billingExistingEmailInput) {
                billingExistingEmailInput.value = card.dataset.billingClientCorreo || '';
            }

            billingExistingNameInput?.focus();
            updateBillingSubmitState();
        }

        function getBillingExtraRows() {
            return Array.from(document.querySelectorAll('.billing-extra-row'));
        }

        function updateBillingExtraIndexes() {
            getBillingExtraRows().forEach((row, index) => {
                const descriptionInput = row.querySelector('input[type="text"]');
                const amountInput = row.querySelector('[data-billing-extra-amount]');

                if (descriptionInput) {
                    descriptionInput.name = `extras[${index}][descripcion]`;
                }

                if (amountInput) {
                    amountInput.name = `extras[${index}][monto]`;
                }
            });
        }

        function updateBillingTotal() {
            if (!billingTotalDisplay) {
                return;
            }

            const citaCosto = Number.parseFloat(billingCostInput?.value || '0') || 0;
            const extrasTotal = getBillingExtraRows().reduce((sum, row) => {
                const amountInput = row.querySelector('[data-billing-extra-amount]');
                return sum + (Number.parseFloat(amountInput?.value || '0') || 0);
            }, 0);

            billingTotalDisplay.textContent = `Q ${(citaCosto + extrasTotal).toFixed(2)}`;
        }

        auditDateFilterInput?.addEventListener('input', () => {
            if (auditDateCutInput) {
                auditDateCutInput.value = auditDateFilterInput.value;
            }
        });

        function createBillingExtraRow(description = '', amount = '') {
            if (!billingExtrasList) {
                return;
            }

            const row = document.createElement('div');
            row.className = 'billing-extra-row';
            row.style.display = 'grid';
            row.style.gridTemplateColumns = 'minmax(0,1.4fr) minmax(140px,0.6fr) auto';
            row.style.gap = '12px';
            row.style.alignItems = 'end';
            row.innerHTML = `
                <div>
                    <label style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Descripcion</label>
                    <input type="text" value="${description}" placeholder="Ej. Proteina, vitaminas, consulta extra" style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                </div>
                <div>
                    <label style="display:block;margin-bottom:8px;color:#5a6f90;font-weight:bold;">Monto</label>
                    <input type="number" min="0" step="0.01" value="${amount}" placeholder="0.00" data-billing-extra-amount style="width:100%;padding:12px 14px;border-radius:12px;border:1px solid #dce6f2;background:#f8fbff;color:#4f6483;outline:none;">
                </div>
                <button type="button" class="delete-button-outline billing-remove-extra" style="height:48px;">Quitar</button>
            `;

            billingExtrasList.appendChild(row);
            updateBillingExtraIndexes();
            updateBillingTotal();
        }

        function ensureBillingAuditEmptyState() {
            if (!billingAuditTableBody) {
                return;
            }

            const hasRows = Boolean(billingAuditTableBody.querySelector('tr[data-billing-audit-row]'));

            if (hasRows) {
                billingAuditTableBody.querySelector('td[colspan="6"]')?.closest('tr')?.remove();
                return;
            }

            if (billingAuditTableBody.querySelector('td[colspan="6"]')) {
                return;
            }

            const emptyRow = document.createElement('tr');
            const auditView = billingAuditTableBody.dataset.auditView || 'dia';
            const auditDate = billingAuditTableBody.dataset.auditDate || '';
            let emptyText = 'No hay facturas registradas para hoy.';

            if (auditView === 'historial') {
                emptyText = auditDate ? 'No hay facturas registradas en la fecha seleccionada.' : 'Todavia no hay facturas registradas.';
            }

            emptyRow.innerHTML = `<td colspan="6" style="text-align:center;">${emptyText}</td>`;
            billingAuditTableBody.appendChild(emptyRow);
        }

        function updateBillingCutSummary(total, count) {
            if (billingCutTotalValue) {
                billingCutTotalValue.textContent = `Q ${Number(total || 0).toFixed(2)}`;
            }

            if (billingCutClientCountValue) {
                billingCutClientCountValue.textContent = `${count || 0}`;
            }
        }

        function buildBillingExtrasDetail(extras) {
            if (!Array.isArray(extras) || extras.length === 0) {
                return '<div>Sin compras extra</div>';
            }

            return extras.map((extra) => {
                const descripcion = extra.descripcion && extra.descripcion.trim() !== '' ? extra.descripcion : 'Compra adicional';
                const monto = Number(extra.monto || 0).toFixed(2);
                return `<div>${descripcion} - Q ${monto}</div>`;
            }).join('');
        }

        function prependBillingAuditRow(invoice) {
            if (!billingAuditTableBody || !invoice) {
                return;
            }

            const auditView = billingAuditTableBody.dataset.auditView || 'dia';
            const auditDate = billingAuditTableBody.dataset.auditDate || '';
            const auditToday = billingAuditTableBody.dataset.auditToday || '';
            const invoiceDate = invoice.billed_at_iso_date || '';

            if (auditView === 'dia' && invoiceDate && auditToday && invoiceDate !== auditToday) {
                return;
            }

            if (auditView === 'historial' && auditDate && invoiceDate && invoiceDate !== auditDate) {
                return;
            }

            billingAuditTableBody.querySelector('td[colspan="6"]')?.closest('tr')?.remove();

            const row = document.createElement('tr');
            row.dataset.billingAuditRow = '';
            row.dataset.billingInvoiceId = invoice.id || '';
            row.innerHTML = `
                <td>${invoice.invoice_number || ''}</td>
                <td>${invoice.cliente_nombre || ''}</td>
                <td>${invoice.cliente_correo || ''}</td>
                <td>${invoice.billed_at_date || ''} ${invoice.billed_at_time || ''}</td>
                <td>Q ${Number(invoice.total || 0).toFixed(2)}</td>
                <td>
                    <div>Cita: Q ${Number(invoice.cita_costo || 0).toFixed(2)}</div>
                    ${buildBillingExtrasDetail(invoice.extras || [])}
                </td>
            `;

            billingAuditTableBody.prepend(row);
            ensureBillingAuditEmptyState();
        }

        function resetBillingFormState() {
            if (!billingForm) {
                return;
            }

            billingForm.reset();

            if (billingExistingIdInput) {
                billingExistingIdInput.value = '';
            }

            if (billingExistingNameInput) {
                billingExistingNameInput.value = '';
            }

            if (billingExistingEmailInput) {
                billingExistingEmailInput.value = '';
            }

            if (billingNewNameInput) {
                billingNewNameInput.value = '';
            }

            if (billingNewEmailInput) {
                billingNewEmailInput.value = '';
            }

            if (billingCostInput) {
                billingCostInput.value = '0.00';
            }

            const existingType = billingForm.querySelector('[data-billing-type][value="existente"]');
            if (existingType) {
                existingType.checked = true;
            }

            if (billingExtrasList) {
                billingExtrasList.innerHTML = '';
                createBillingExtraRow();
            }

            syncBillingClientFields();
            updateBillingExtraIndexes();
            updateBillingTotal();
            updateBillingSubmitState();
        }

        function triggerFileDownload(url) {
            if (!url) {
                return;
            }

            const link = document.createElement('a');
            link.href = url;
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            link.remove();
        }

        function ensureAgendaEmptyState(tableBody, message, colspan = 7, rowSelector = 'tr[data-agenda-appointment-row]') {
            if (!tableBody) {
                return;
            }

            const hasRows = Boolean(tableBody.querySelector(rowSelector));

            if (hasRows) {
                tableBody.querySelector(`td[colspan="${colspan}"]`)?.closest('tr')?.remove();
                return;
            }

            if (tableBody.querySelector(`td[colspan="${colspan}"]`)) {
                return;
            }

            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = `<td colspan="${colspan}" style="text-align:center;">${message}</td>`;
            tableBody.appendChild(emptyRow);
        }

        function isAgendaAppointmentUpcoming(row) {
            const appointmentAt = row?.dataset.agendaAppointmentAt || '';

            if (!appointmentAt) {
                return false;
            }

            const appointmentDate = new Date(appointmentAt);

            if (Number.isNaN(appointmentDate.getTime())) {
                return false;
            }

            return appointmentDate.getTime() + (30 * 60 * 1000) > Date.now();
        }

        function updateAgendaStatusButton(button, isCompleted, row = null) {
            if (!button) {
                return;
            }

            const isUpcoming = !isCompleted && isAgendaAppointmentUpcoming(row || button.closest('[data-agenda-appointment-row]'));

            button.classList.toggle('is-completed', isCompleted);
            button.classList.toggle('is-upcoming', isUpcoming);
            button.classList.toggle('is-pending', !isCompleted && !isUpcoming);
            button.setAttribute('aria-label', isCompleted ? 'Devolver cita a pendientes' : 'Marcar cita como completada');
            button.setAttribute('title', isCompleted ? 'Devolver a pendientes' : (isUpcoming ? 'Cita pendiente futura' : 'Cita pendiente vencida'));
        }

        function isAgendaAppointmentGreen(row, isCompleted = null) {
            const completed = isCompleted === null
                ? row?.dataset.agendaCompleted === '1'
                : isCompleted;

            return !completed && isAgendaAppointmentUpcoming(row);
        }

        function placeAgendaAppointmentRow(row) {
            if (!row) {
                return;
            }

            const isCompleted = row.dataset.agendaCompleted === '1';
            const targetBody = isAgendaAppointmentGreen(row, isCompleted) ? agendaPendingTableBody : agendaCompletedTableBody;

            targetBody?.appendChild(row);
            ensureAgendaEmptyState(agendaPendingTableBody, 'No hay citas pendientes para hoy.');
            ensureAgendaEmptyState(agendaCompletedTableBody, 'No hay citas completadas para hoy.');
        }

        function refreshAgendaTimeStatus() {
            document.querySelectorAll('[data-agenda-appointment-row]').forEach((row) => {
                const isCompleted = row.dataset.agendaCompleted === '1';
                updateAgendaStatusButton(row.querySelector('[data-agenda-status-button]'), isCompleted, row);
                placeAgendaAppointmentRow(row);
                syncNotificationAppointmentRow(row, isCompleted);
            });
        }

        function refreshRescheduleTimeStatus() {
            document.querySelectorAll('[data-reschedule-appointment-at]').forEach((link) => {
                const isCompleted = link.dataset.rescheduleCompleted === '1';
                const appointmentDate = new Date(link.dataset.rescheduleAppointmentAt || '');
                const isUpcoming = !isCompleted && !Number.isNaN(appointmentDate.getTime()) && appointmentDate.getTime() + (30 * 60 * 1000) > Date.now();

                link.classList.toggle('is-completed', isCompleted);
                link.classList.toggle('is-upcoming', isUpcoming);
                link.classList.toggle('is-due', !isCompleted && !isUpcoming);
            });
        }

        function syncRescheduleAppointmentStatus(row, isCompleted) {
            const appointmentId = row?.dataset.agendaAppointmentId || '';

            if (!appointmentId) {
                return;
            }

            document.querySelectorAll(`[data-reschedule-appointment-id="${appointmentId}"]`).forEach((link) => {
                link.dataset.rescheduleCompleted = isCompleted ? '1' : '0';
            });

            refreshRescheduleTimeStatus();
        }

        function buildNotificationAppointmentRow(row) {
            if (!row) {
                return null;
            }

            const notificationRow = document.createElement('tr');
            notificationRow.dataset.notificationAppointmentRow = '';
            notificationRow.dataset.notificationAppointmentId = row.dataset.agendaAppointmentId || '';

            const sourceCells = row.querySelectorAll('td');

            [1, 2, 3, 4, 5, 6].forEach((index) => {
                const cell = document.createElement('td');
                cell.innerHTML = sourceCells[index]?.innerHTML || '';
                notificationRow.appendChild(cell);
            });

            return notificationRow;
        }

        function syncNotificationAppointmentRow(row, isCompleted) {
            if (!notificationsTableBody || !row) {
                return;
            }

            const appointmentId = row.dataset.agendaAppointmentId || '';
            const existingNotificationRow = appointmentId
                ? notificationsTableBody.querySelector(`[data-notification-appointment-id="${appointmentId}"]`)
                : null;

            if (isCompleted || !isAgendaAppointmentGreen(row, isCompleted)) {
                existingNotificationRow?.remove();
                ensureAgendaEmptyState(notificationsTableBody, 'No hay citas pendientes del dia para notificar.', 6, 'tr[data-notification-appointment-row]');
                return;
            }

            if (existingNotificationRow) {
                const replacement = buildNotificationAppointmentRow(row);
                if (replacement) {
                    existingNotificationRow.replaceWith(replacement);
                }
            } else {
                notificationsTableBody.querySelector('td[colspan="6"]')?.closest('tr')?.remove();
                const newRow = buildNotificationAppointmentRow(row);
                if (newRow) {
                    notificationsTableBody.appendChild(newRow);
                }
            }

            ensureAgendaEmptyState(notificationsTableBody, 'No hay citas pendientes del dia para notificar.', 6, 'tr[data-notification-appointment-row]');
        }

        function moveAgendaAppointmentRow(row, isCompleted) {
            if (!row) {
                return;
            }

            row.dataset.agendaCompleted = isCompleted ? '1' : '0';
            updateAgendaStatusButton(row.querySelector('[data-agenda-status-button]'), isCompleted, row);
            placeAgendaAppointmentRow(row);

            ensureAgendaEmptyState(agendaPendingTableBody, 'No hay citas pendientes para hoy.');
            ensureAgendaEmptyState(agendaCompletedTableBody, 'No hay citas completadas para hoy.');
            syncNotificationAppointmentRow(row, isCompleted);
            syncRescheduleAppointmentStatus(row, isCompleted);
        }

        function resetCargaSensitiveFields() {
            if (cargaDpiInput) {
                cargaDpiInput.value = '';
            }

            if (cargaPasswordInput) {
                cargaPasswordInput.value = '';
                cargaPasswordInput.type = 'password';
            }

            if (toggleCargaPassword) {
                toggleCargaPassword.checked = false;
            }
        }

        function showCargaForm(user = null) {
            if (!cargaFormBox || !cargaUserForm) {
                return;
            }

            cargaUserForm.reset();
            cargaUserForm.action = user?.updateUrl || cargaUserForm.dataset.storeAction;
            cargaUserForm.dataset.editingUserId = user?.id || '';
            if (cargaEditingIdInput) {
                cargaEditingIdInput.value = user?.id || '';
            }

            if (cargaFormTitle) {
                cargaFormTitle.textContent = user ? 'Editar usuario de Cargas' : 'Nuevo usuario de Cargas';
            }

            if (cargaSubmitButton) {
                cargaSubmitButton.textContent = user ? 'Actualizar usuario' : 'Guardar usuario';
            }

            if (cargaNombreInput) {
                cargaNombreInput.value = user?.nombre || '';
            }

            if (cargaCorreoInput) {
                cargaCorreoInput.value = user?.correo || '';
            }

            if (cargaDpiInput) {
                cargaDpiInput.value = user?.dpi || '';
            }

            if (cargaPasswordInput) {
                cargaPasswordInput.required = !user;
                cargaPasswordInput.placeholder = user ? 'Dejar en blanco para mantenerla' : '';
                cargaPasswordInput.value = '';
                cargaPasswordInput.type = 'password';
            }

            if (toggleCargaPassword) {
                toggleCargaPassword.checked = false;
            }

            cargaFormBox.style.display = 'block';
            cargasListBox?.style.setProperty('display', 'none');
            detailBox?.classList.remove('is-visible');
            toggleCargaForm?.style.setProperty('display', 'none');
            backCargaList?.style.setProperty('display', 'inline-flex');
        }

        function showCargaList() {
            if (!cargaFormBox) {
                return;
            }

            cargaFormBox.style.display = 'none';
            cargasListBox?.style.removeProperty('display');
            toggleCargaForm?.style.removeProperty('display');
            backCargaList?.style.setProperty('display', 'none');
            cargaUserForm?.reset();
            cargaUserForm?.setAttribute('action', cargaUserForm.dataset.storeAction || '');
            if (cargaUserForm) {
                cargaUserForm.dataset.editingUserId = '';
            }
            if (cargaEditingIdInput) {
                cargaEditingIdInput.value = '';
            }
            if (cargaFormTitle) {
                cargaFormTitle.textContent = 'Nuevo usuario de Cargas';
            }
            if (cargaSubmitButton) {
                cargaSubmitButton.textContent = 'Guardar usuario';
            }
            if (cargaPasswordInput) {
                cargaPasswordInput.required = true;
                cargaPasswordInput.placeholder = '';
            }
            resetCargaSensitiveFields();
        }

        if (toggleCargaForm && cargaFormBox) {
            toggleCargaForm.addEventListener('click', () => {
                const isVisible = cargaFormBox.style.display === 'block' && cargasListBox?.style.display === 'none';
                if (isVisible) {
                    showCargaList();
                    return;
                }
                showCargaForm();
            });
        }

        if (backCargaList) {
            backCargaList.addEventListener('click', () => {
                showCargaList();
            });
        }

        if (toggleCargaPassword && cargaPasswordInput) {
            toggleCargaPassword.addEventListener('change', () => {
                cargaPasswordInput.type = toggleCargaPassword.checked ? 'text' : 'password';
            });
        }

        if (cargaUserForm) {
            cargaUserForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                const button = cargaUserForm.querySelector('button[type="submit"]');
                button?.setAttribute('disabled', 'disabled');

                try {
                    const response = await fetch(cargaUserForm.action, {
                        method: 'POST',
                        body: new FormData(cargaUserForm),
                        headers: {
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        credentials: 'same-origin',
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        const firstError = data?.errors ? Object.values(data.errors).flat()[0] : null;
                        throw new Error(firstError || data.message || 'No se pudo guardar el usuario.');
                    }

                    upsertCargaUserRow(data.user);
                    showCargaList();
                    resetCargaSensitiveFields();
                    showFloatingToast(data.message || 'Usuario guardado correctamente.');
                } catch (error) {
                    showFloatingToast(error.message || 'No se pudo guardar el usuario.');
                } finally {
                    button?.removeAttribute('disabled');
                }
            });
        }

        resetCargaSensitiveFields();

        @if ($errors->any() && old('carga_editing_id'))
            showCargaForm({
                id: @json(old('carga_editing_id')),
                nombre: @json(old('nombre')),
                correo: @json(old('correo')),
                dpi: @json(old('dpi')),
                updateUrl: @json(route('panel.cargas.update', old('carga_editing_id'))),
            });
        @elseif ($errors->any())
            cargaFormBox?.style.setProperty('display', 'block');
        @endif

        if (toggleSystemUserForm && systemUserFormBox) {
            toggleSystemUserForm.addEventListener('click', () => {
                showSystemUserForm();
            });
        }

        if (backSystemUserList && systemUserFormBox) {
            backSystemUserList.addEventListener('click', () => {
                showSystemUserList();
            });
        }

        function showSystemUserForm(user = null) {
            if (!systemUserForm || !systemUserFormBox) {
                return;
            }

            adminRecoveryMode = false;
            systemUserForm.reset();
            systemUserForm.action = user?.updateUrl || systemUserForm.dataset.storeAction;
            systemUserForm.dataset.editingUserId = user?.id || '';
            systemUserForm.dataset.currentRole = user?.role || '';

            if (systemUserFormTitle) {
                systemUserFormTitle.textContent = user ? 'Editar usuario del sistema' : 'Nuevo usuario del sistema';
            }

            if (systemUserSubmitButton) {
                systemUserSubmitButton.textContent = user ? 'Actualizar usuario' : 'Guardar usuario';
            }

            if (systemNameInput) {
                systemNameInput.value = user?.name || '';
            }

            if (systemEmailInput) {
                systemEmailInput.value = user?.email || '';
            }

            if (systemRoleInput) {
                systemRoleInput.value = user?.role || 'usuario';
            }

            if (systemCurrentPasswordInput) {
                systemCurrentPasswordInput.type = 'password';
                systemCurrentPasswordInput.value = '';
                systemCurrentPasswordInput.required = false;
            }

            if (systemPasswordInput) {
                systemPasswordInput.required = !user;
                systemPasswordInput.type = 'password';
                systemPasswordInput.value = '';
                systemPasswordInput.placeholder = user ? 'Dejar en blanco para mantenerla' : '';
                systemPasswordInput.disabled = false;
                if (toggleSystemPassword) {
                    toggleSystemPassword.checked = false;
                }
                updatePasswordHints();
            }

            if (adminVerificationCodeInput) {
                adminVerificationCodeInput.value = '';
            }

            updateAdminResetState(Boolean(user));

            systemUserFormBox.style.display = 'block';
            systemUsersListBox?.style.setProperty('display', 'none');
            toggleSystemUserForm?.style.setProperty('display', 'none');
        }

        function showSystemUserList() {
            adminRecoveryMode = false;
            systemUserFormBox?.style.setProperty('display', 'none');
            systemUsersListBox?.style.removeProperty('display');
            toggleSystemUserForm?.style.removeProperty('display');
        }

        function buildAdminActionUrl(template, userId) {
            if (!template || !userId) {
                return '';
            }

            return template.replace('__USER__', userId);
        }

        function updateAdminResetState(isEditingUser = false) {
            const isAdmin = systemRoleInput?.value === 'administrador';
            const currentRole = systemUserForm?.dataset.currentRole || '';
            const isEditingAdmin = isEditingUser && currentRole === 'administrador' && isAdmin;

            adminResetBox?.classList.toggle('is-visible', isEditingAdmin && adminRecoveryMode);

            if (systemCurrentPasswordField) {
                systemCurrentPasswordField.style.display = isEditingAdmin ? 'block' : 'none';
            }

            if (systemCurrentPasswordInput) {
                systemCurrentPasswordInput.required = false;
                systemCurrentPasswordInput.value = '';
                systemCurrentPasswordInput.type = 'password';
                systemCurrentPasswordInput.placeholder = isEditingAdmin
                    ? 'Ingresa la contrasena actual'
                    : '';
                systemCurrentPasswordInput.setCustomValidity('');
            }

            if (systemPasswordInput) {
                systemPasswordInput.disabled = false;
                systemPasswordInput.required = !isEditingUser;
                systemPasswordInput.value = '';
                systemPasswordInput.type = 'password';
                systemPasswordInput.placeholder = isEditingAdmin
                    ? 'Ingresa la nueva contrasena'
                    : (isEditingUser ? 'Dejar en blanco para mantenerla' : '');
                systemPasswordInput.setCustomValidity('');
            }

            if (toggleSystemPassword) {
                toggleSystemPassword.checked = false;
            }

            if (systemPasswordLabel) {
                systemPasswordLabel.textContent = isEditingAdmin ? 'Contrasena nueva' : 'Contrasena';
            }

            if (passwordCheckLabel) {
                passwordCheckLabel.style.display = 'inline-flex';
            }

            if (goToAdminResetLink) {
                goToAdminResetLink.style.display = isEditingAdmin ? 'block' : 'none';
            }

            if (adminResetHelp) {
                adminResetHelp.textContent = '';
            }

            if (adminVerificationCodeInput && !isEditingAdmin) {
                adminVerificationCodeInput.value = '';
            }

            if (!isEditingAdmin) {
                adminRecoveryMode = false;
            }

            updatePasswordHints();
        }

        function showFloatingToast(message) {
            if (!floatingToast) {
                return;
            }

            floatingToast.textContent = message;
            floatingToast.classList.add('is-visible');

            window.clearTimeout(showFloatingToast.timer);
            showFloatingToast.timer = window.setTimeout(() => {
                floatingToast.classList.remove('is-visible');
            }, 2600);
        }

        function getPasswordRules(value) {
            return {
                length: value.length >= 8,
                case: /[a-z]/.test(value) && /[A-Z]/.test(value),
                number: /\d/.test(value),
                symbol: /[^A-Za-z0-9]/.test(value),
            };
        }

        function updatePasswordHints() {
            if (!systemPasswordInput) {
                return;
            }

            const rules = getPasswordRules(systemPasswordInput.value);

            passwordHintItems.forEach((item) => {
                item.classList.toggle('is-valid', Boolean(rules[item.dataset.passwordRule]));
            });

            if (!systemPasswordInput.required && systemPasswordInput.value === '') {
                systemPasswordInput.setCustomValidity('');
                return;
            }

            if (!rules.length) {
                systemPasswordInput.setCustomValidity('La contrasena debe tener al menos 8 caracteres.');
                return;
            }

            if (!rules.case) {
                systemPasswordInput.setCustomValidity('La contrasena debe incluir mayusculas y minusculas.');
                return;
            }

            if (!rules.number) {
                systemPasswordInput.setCustomValidity('La contrasena debe incluir al menos un numero.');
                return;
            }

            if (!rules.symbol) {
                systemPasswordInput.setCustomValidity('La contrasena debe incluir al menos un simbolo.');
                return;
            }

            systemPasswordInput.setCustomValidity('');
        }

        function passwordIsValidForSystemForm() {
            if (!systemPasswordInput || (!systemPasswordInput.required && systemPasswordInput.value === '')) {
                return true;
            }

            return Object.values(getPasswordRules(systemPasswordInput.value)).every(Boolean);
        }

        function adminPasswordFieldsAreValid() {
            const isEditingAdmin = Boolean(systemUserForm?.dataset.editingUserId)
                && (systemUserForm?.dataset.currentRole || '') === 'administrador'
                && systemRoleInput?.value === 'administrador';

            if (!isEditingAdmin || !systemCurrentPasswordInput || !systemPasswordInput) {
                return true;
            }

            const hasCurrentPassword = systemCurrentPasswordInput.value.trim() !== '';
            const hasNewPassword = systemPasswordInput.value.trim() !== '';

            systemCurrentPasswordInput.setCustomValidity('');
            systemPasswordInput.setCustomValidity('');

            if (!hasCurrentPassword && !hasNewPassword) {
                return true;
            }

            if (!hasCurrentPassword) {
                systemCurrentPasswordInput.setCustomValidity('Ingresa la contrasena actual.');
                return false;
            }

            if (!hasNewPassword) {
                systemPasswordInput.setCustomValidity('Ingresa la nueva contrasena.');
                return false;
            }

            return true;
        }

        function setSpanishFieldMessage(field) {
            if (field === systemPasswordInput) {
                updatePasswordHints();
                return;
            }

            field.setCustomValidity('');

            if (field.validity.valueMissing) {
                field.setCustomValidity('Este campo es obligatorio.');
                return;
            }

            if (field.validity.typeMismatch && field.type === 'email') {
                field.setCustomValidity('Ingresa un correo valido.');
                return;
            }

            if (field.validity.tooShort) {
                field.setCustomValidity(`Debe tener al menos ${field.minLength} caracteres.`);
            }
        }

        function showDeleteConfirm(row) {
            pendingDeleteRow = row;
            pendingDeleteConfig = {
                url: row?.dataset.systemUserDeleteUrl || '',
                successMessage: 'Usuario eliminado correctamente.',
                title: 'Eliminar usuario',
                text: 'Esta accion quitara el usuario seleccionado del sistema. Puedes cancelar si no deseas continuar.',
            };
            if (deleteConfirmTitle) {
                deleteConfirmTitle.textContent = pendingDeleteConfig.title;
            }
            if (deleteConfirmText) {
                deleteConfirmText.textContent = pendingDeleteConfig.text;
            }
            deleteConfirmOverlay?.classList.add('is-visible');
            deleteConfirmOverlay?.setAttribute('aria-hidden', 'false');
        }

        function showCargaDeleteConfirm(form) {
            pendingDeleteRow = form?.closest('tr') || null;
            pendingDeleteConfig = {
                url: form?.getAttribute('action') || '',
                targetId: pendingDeleteRow?.dataset.cargaUserId || '',
                successMessage: 'Usuario eliminado correctamente de Cargas.',
                title: 'Eliminar usuario de Cargas',
                text: 'Esta accion quitara el usuario seleccionado de Cargas. Puedes cancelar si no deseas continuar.',
            };
            if (deleteConfirmTitle) {
                deleteConfirmTitle.textContent = pendingDeleteConfig.title;
            }
            if (deleteConfirmText) {
                deleteConfirmText.textContent = pendingDeleteConfig.text;
            }
            deleteConfirmOverlay?.classList.add('is-visible');
            deleteConfirmOverlay?.setAttribute('aria-hidden', 'false');
        }

        function hideDeleteConfirm() {
            pendingDeleteRow = null;
            pendingDeleteConfig = null;
            deleteConfirmOverlay?.classList.remove('is-visible');
            deleteConfirmOverlay?.setAttribute('aria-hidden', 'true');
        }

        function ensureCargasEmptyState() {
            if (!cargasTableBody) {
                return;
            }

            const hasDataRows = Boolean(cargasTableBody.querySelector('tr[data-carga-user-id]'));

            if (hasDataRows) {
                cargasTableBody.querySelector('td[colspan="5"]')?.closest('tr')?.remove();
                return;
            }

            if (cargasTableBody.querySelector('td[colspan="5"]')) {
                return;
            }

            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = '<td colspan="5">Todavia no hay usuarios en Cargas.</td>';
            cargasTableBody.appendChild(emptyRow);
        }

        function escapeHtml(value) {
            const div = document.createElement('div');
            div.textContent = value ?? '';
            return div.innerHTML;
        }

        function buildCargaUserRow(user) {
            const row = document.createElement('tr');
            const userId = escapeHtml(user.id || '');
            const userName = escapeHtml(user.nombre || '');
            const userEmail = escapeHtml(user.correo || '');
            const userDpi = escapeHtml(user.dpi || '');
            const userInitial = escapeHtml(user.initial || (user.nombre || 'U').charAt(0).toUpperCase());
            const updateUrl = escapeHtml(user.update_url || '');
            const deleteUrl = escapeHtml(user.delete_url || '');

            row.dataset.searchRow = '';
            row.dataset.cargaUserId = user.id || '';
            row.dataset.cargaUserNombre = user.nombre || '';
            row.dataset.cargaUserCorreo = user.correo || '';
            row.dataset.cargaUserDpi = user.dpi || '';
            row.dataset.cargaUserUpdateUrl = user.update_url || '';
            row.dataset.searchText = user.search || `${user.nombre || ''} ${user.dpi || ''}`.toLowerCase();

            row.innerHTML = `
                <td>${userId}</td>
                <td>
                    <button type="button" class="workspace-user-chip workspace-user-trigger" data-user-id="${userId}" data-user-nombre="${userName}" data-user-correo="${userEmail}" data-user-dpi="${userDpi}">
                        <div class="workspace-avatar">${userInitial}</div>
                        <strong>${userName}</strong>
                    </button>
                </td>
                <td>${userEmail}</td>
                <td>${userDpi}</td>
                <td>
                    <div class="workspace-actions">
                        <button type="button" class="workspace-action-button action-edit" data-carga-edit-button><span>Editar</span></button>
                        <form action="${deleteUrl}" method="POST" data-carga-delete-form>
                            <button type="button" class="workspace-action-button action-delete" data-carga-delete-button><span>Eliminar</span></button>
                        </form>
                    </div>
                </td>
            `;

            return row;
        }

        function upsertCargaUserRow(user) {
            if (!cargasTableBody || !user) {
                return;
            }

            cargasTableBody.querySelector('td[colspan="5"]')?.closest('tr')?.remove();

            const existingRow = cargasTableBody.querySelector(`[data-carga-user-id="${user.id}"]`);
            const nextRow = buildCargaUserRow(user);

            if (existingRow) {
                existingRow.replaceWith(nextRow);
            } else {
                cargasTableBody.prepend(nextRow);
            }

            ensureCargasEmptyState();
            filterRows(searchInputs[0]?.value || '');
        }

        function addSystemUserRow(user) {
            if (!systemUsersTableBody) {
                return;
            }

            systemUsersTableBody.querySelector('td[colspan]')?.closest('tr')?.remove();

            const row = document.createElement('tr');
            row.dataset.systemUserRow = '';
            row.dataset.systemUserId = user.id;
            row.dataset.systemUserName = user.name;
            row.dataset.systemUserEmail = user.email;
            row.dataset.systemUserRole = user.role_value;
            row.dataset.systemUserUpdateUrl = user.update_url;
            row.dataset.systemUserDeleteUrl = user.delete_url;
            row.dataset.systemUserText = user.search || `${user.name} ${user.email}`.toLowerCase();

            const idCell = document.createElement('td');
            idCell.textContent = user.id;

            const userCell = document.createElement('td');
            const chip = document.createElement('div');
            chip.className = 'workspace-user-chip';

            const avatar = document.createElement('div');
            avatar.className = 'workspace-avatar';
            avatar.textContent = user.initial;

            const name = document.createElement('strong');
            name.textContent = user.name;

            chip.append(avatar, name);
            userCell.appendChild(chip);

            const emailCell = document.createElement('td');
            emailCell.textContent = user.email;

            const roleCell = document.createElement('td');
            roleCell.textContent = user.role;

            const actionsCell = document.createElement('td');
            const actions = document.createElement('div');
            actions.className = 'workspace-actions';

            const editButton = document.createElement('button');
            editButton.type = 'button';
            editButton.className = 'workspace-action-button action-edit';
            editButton.dataset.systemUserEdit = '';
            editButton.title = 'Editar';
            editButton.innerHTML = '<span>✎</span><span>Editar</span>';
            actions.appendChild(editButton);

            if (user.role_value === 'usuario') {
                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'workspace-action-button action-delete';
                deleteButton.dataset.systemUserDelete = '';
                deleteButton.title = 'Eliminar';
                deleteButton.innerHTML = '<span>🗑</span><span>Eliminar</span>';
                actions.appendChild(deleteButton);
            }

            actionsCell.appendChild(actions);
            row.append(idCell, userCell, emailCell, roleCell, actionsCell);
            systemUsersTableBody.prepend(row);
        }

        function updateSystemUserRow(row, user) {
            if (!row) {
                return;
            }

            row.dataset.systemUserName = user.name;
            row.dataset.systemUserEmail = user.email;
            row.dataset.systemUserRole = user.role_value;
            row.dataset.systemUserText = user.search;
            row.dataset.systemUserUpdateUrl = user.update_url;
            row.dataset.systemUserDeleteUrl = user.delete_url;

            const cells = row.querySelectorAll('td');
            const avatar = row.querySelector('.workspace-avatar');
            const name = row.querySelector('.workspace-user-chip strong');

            if (avatar) {
                avatar.textContent = user.initial;
            }

            if (name) {
                name.textContent = user.name;
            }

            if (cells[2]) {
                cells[2].textContent = user.email;
            }

            if (cells[3]) {
                cells[3].textContent = user.role;
            }

            const actions = row.querySelector('.workspace-actions');
            const deleteButton = row.querySelector('[data-system-user-delete]');

            if (actions && user.role_value === 'usuario' && !deleteButton) {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'workspace-action-button action-delete';
                button.dataset.systemUserDelete = '';
                button.title = 'Eliminar';
                button.innerHTML = '<span>🗑</span><span>Eliminar</span>';
                actions.appendChild(button);
            }

            if (deleteButton && user.role_value !== 'usuario') {
                deleteButton.remove();
            }
        }

        if (systemUserForm) {
            systemUserForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                if (!adminPasswordFieldsAreValid()) {
                    systemCurrentPasswordInput?.reportValidity();
                    systemPasswordInput?.reportValidity();
                    return;
                }

                if (!passwordIsValidForSystemForm()) {
                    systemPasswordInput?.reportValidity();
                    updatePasswordHints();
                    return;
                }

                const button = systemUserForm.querySelector('button[type="submit"]');
                button?.setAttribute('disabled', 'disabled');

                try {
                    const response = await fetch(systemUserForm.action, {
                        method: 'POST',
                        body: new FormData(systemUserForm),
                        headers: {
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        credentials: 'same-origin',
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        const firstError = data?.errors
                            ? Object.values(data.errors).flat()[0]
                            : null;
                        throw new Error(firstError || data.message || 'No se pudo guardar el usuario.');
                    }

                    const editingUserId = systemUserForm.dataset.editingUserId;
                    const existingRow = editingUserId
                        ? systemUsersTableBody?.querySelector(`[data-system-user-id="${editingUserId}"]`)
                        : null;

                    if (existingRow) {
                        updateSystemUserRow(existingRow, data.user);
                    } else {
                        addSystemUserRow(data.user);
                    }

                    systemUserForm.reset();
                    showSystemUserList();
                } catch (error) {
                    showFloatingToast(error.message || 'No se pudo guardar el usuario.');
                } finally {
                    button?.removeAttribute('disabled');
                }
            });
        }

        if (systemUsersTableBody) {
            systemUsersTableBody.addEventListener('click', async (event) => {
                const editButton = event.target.closest('[data-system-user-edit]');
                const deleteButton = event.target.closest('[data-system-user-delete]');
                const row = event.target.closest('[data-system-user-row]');

                if (!row) {
                    return;
                }

                if (editButton) {
                    showSystemUserForm({
                        id: row.dataset.systemUserId,
                        name: row.dataset.systemUserName,
                        email: row.dataset.systemUserEmail,
                        role: row.dataset.systemUserRole,
                        updateUrl: row.dataset.systemUserUpdateUrl,
                    });
                    return;
                }

                if (!deleteButton) {
                    return;
                }

                showDeleteConfirm(row);
            });
        }

        if (cancelDeleteUser) {
            cancelDeleteUser.addEventListener('click', hideDeleteConfirm);
        }

        if (deleteConfirmOverlay) {
            deleteConfirmOverlay.addEventListener('click', (event) => {
                if (event.target === deleteConfirmOverlay) {
                    hideDeleteConfirm();
                }
            });
        }

        if (confirmDeleteUser) {
            confirmDeleteUser.addEventListener('click', async () => {
                const row = pendingDeleteRow;
                const deleteUrl = pendingDeleteConfig?.url || row?.dataset.systemUserDeleteUrl;

                if (!deleteUrl) {
                    return;
                }

                confirmDeleteUser.setAttribute('disabled', 'disabled');

                try {
                    const response = await fetch(deleteUrl, {
                        method: 'DELETE',
                        headers: {
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        credentials: 'same-origin',
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        throw new Error(data.message || 'No se pudo eliminar el usuario.');
                    }

                    const deletedId = String(data.id || pendingDeleteConfig?.targetId || '');
                    const targetRow = row || (deletedId ? document.querySelector(`[data-carga-user-id="${deletedId}"]`) : null);

                    targetRow?.remove();
                    ensureCargasEmptyState();

                    if (deletedId && detailUserId?.textContent === deletedId) {
                        detailBox?.classList.remove('is-visible');
                    }

                    if (deletedId && cargaUserForm?.dataset.editingUserId === deletedId) {
                        showCargaList();
                    }

                    hideDeleteConfirm();
                    showFloatingToast(pendingDeleteConfig?.successMessage || 'Usuario eliminado correctamente.');
                } catch (error) {
                    console.error(error);
                } finally {
                    confirmDeleteUser.removeAttribute('disabled');
                }
            });
        }

        if (toggleSystemPassword && systemPasswordInput) {
            toggleSystemPassword.addEventListener('change', () => {
                const nextType = toggleSystemPassword.checked ? 'text' : 'password';
                systemPasswordInput.type = nextType;

                if (systemCurrentPasswordInput) {
                    systemCurrentPasswordInput.type = nextType;
                }
            });
        }

        if (goToAdminResetLink && adminResetBox) {
            goToAdminResetLink.addEventListener('click', () => {
                adminRecoveryMode = true;
                updateAdminResetState(Boolean(systemUserForm?.dataset.editingUserId));
                adminResetBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
                window.setTimeout(() => {
                    adminVerificationCodeInput?.focus();
                }, 280);
            });
        }

        systemRoleInput?.addEventListener('change', () => {
            updateAdminResetState(Boolean(systemUserForm?.dataset.editingUserId));
        });

        if (sendAdminCodeButton && systemUserForm) {
            sendAdminCodeButton.addEventListener('click', async () => {
                const userId = systemUserForm.dataset.editingUserId;
                const url = buildAdminActionUrl(systemUserForm.dataset.adminCodeUrlTemplate, userId);

                if (!url) {
                    return;
                }

                sendAdminCodeButton.setAttribute('disabled', 'disabled');

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        credentials: 'same-origin',
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        throw new Error(data.message || 'No se pudo enviar el codigo.');
                    }

                    showFloatingToast(data.message || 'Codigo enviado correctamente.');
                } catch (error) {
                    showFloatingToast(error.message || 'No se pudo enviar el codigo.');
                } finally {
                    sendAdminCodeButton.removeAttribute('disabled');
                }
            });
        }

        if (confirmAdminCodeButton && systemUserForm && adminVerificationCodeInput) {
            confirmAdminCodeButton.addEventListener('click', async () => {
                const userId = systemUserForm.dataset.editingUserId;
                const url = buildAdminActionUrl(systemUserForm.dataset.adminResetUrlTemplate, userId);
                const verificationCode = adminVerificationCodeInput.value.trim();

                if (!url) {
                    return;
                }

                if (!/^\d{6}$/.test(verificationCode)) {
                    adminVerificationCodeInput.setCustomValidity('El codigo debe tener 6 numeros.');
                    adminVerificationCodeInput.reportValidity();
                    return;
                }

                adminVerificationCodeInput.setCustomValidity('');
                confirmAdminCodeButton.setAttribute('disabled', 'disabled');

                try {
                    const formData = new FormData();
                    formData.append('verification_code', verificationCode);

                    const response = await fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        credentials: 'same-origin',
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        throw new Error(data.message || 'No se pudo confirmar el codigo.');
                    }

                    adminVerificationCodeInput.value = '';
                    showFloatingToast(data.message || 'Nueva contrasena enviada correctamente.');
                } catch (error) {
                    showFloatingToast(error.message || 'No se pudo confirmar el codigo.');
                } finally {
                    confirmAdminCodeButton.removeAttribute('disabled');
                }
            });
        }

        if (systemPasswordInput) {
            ['paste', 'drop'].forEach((eventName) => {
                systemPasswordInput.addEventListener(eventName, (event) => {
                    event.preventDefault();
                });
            });
        }

        if (systemCurrentPasswordInput) {
            systemCurrentPasswordInput.addEventListener('input', () => {
                systemCurrentPasswordInput.setCustomValidity('');
            });
        }

        systemPasswordInput?.addEventListener('input', updatePasswordHints);
        systemFormFields.forEach((field) => {
            field.addEventListener('invalid', () => {
                setSpanishFieldMessage(field);
            });

            field.addEventListener('input', () => {
                field.setCustomValidity('');
                if (field === systemPasswordInput) {
                    updatePasswordHints();
                }
            });
        });
        updatePasswordHints();

        function filterRows(value) {
            const normalized = value.trim().toLowerCase();

            document.querySelectorAll('[data-search-row]').forEach((row) => {
                const text = row.dataset.searchText || '';
                row.style.display = text.includes(normalized) ? '' : 'none';
            });

            document.querySelectorAll('[data-system-user-row]').forEach((row) => {
                const text = row.dataset.systemUserText || '';
                row.style.display = text.includes(normalized) ? '' : 'none';
            });
        }

        function filterRecipeRows(value) {
            const normalized = value.trim().toLowerCase();
            const activeRangeButton = document.querySelector('[data-panel-section="recetas"] .history-filter-group a.is-active');
            const activeRangeUrl = activeRangeButton ? new URL(activeRangeButton.href, window.location.href) : null;
            const activeRange = activeRangeUrl?.searchParams.get('recipe_range') || 'todos';

            document.querySelectorAll('[data-recipe-row]').forEach((row) => {
                const text = row.dataset.recipeText || '';
                const matchesRange = activeRange === 'todos' || row.dataset.recipeRange === activeRange;
                row.style.display = matchesRange && text.includes(normalized) ? '' : 'none';
            });
        }

        function sortRecipeRows() {
            const currentRecipeRows = Array.from(document.querySelectorAll('[data-recipe-row]'));
            const tableBody = currentRecipeRows[0]?.parentElement;
            const rangeOrder = {
                alto: 1,
                medio: 2,
                bajo: 3,
            };

            if (!tableBody) {
                return;
            }

            currentRecipeRows
                .sort((firstRow, secondRow) => {
                    const firstOrder = rangeOrder[firstRow.dataset.recipeRange] || 99;
                    const secondOrder = rangeOrder[secondRow.dataset.recipeRange] || 99;

                    if (firstOrder !== secondOrder) {
                        return firstOrder - secondOrder;
                    }

                    return (firstRow.dataset.recipeName || '').localeCompare(secondRow.dataset.recipeName || '');
                })
                .forEach((row) => tableBody.appendChild(row));
        }

        function filterRecipeRange(range) {
            const selectedRange = range || 'todos';

            document.querySelectorAll('[data-recipe-row]').forEach((row) => {
                const matchesRange = selectedRange === 'todos' || row.dataset.recipeRange === selectedRange;
                const text = row.dataset.recipeText || '';
                const searchValue = recipeSearchInput?.value.trim().toLowerCase() || '';
                row.style.display = matchesRange && text.includes(searchValue) ? '' : 'none';
            });

            document.querySelectorAll('[data-panel-section="recetas"] .history-filter-group a').forEach((button) => {
                const url = new URL(button.href, window.location.href);
                button.classList.toggle('is-active', (url.searchParams.get('recipe_range') || 'todos') === selectedRange);
            });
        }

        function showRecipeList(url) {
            recipeListToolbar?.style.removeProperty('display');
            recipeListShell?.style.removeProperty('display');
            recipeDetailPanels.forEach((panel) => {
                panel.style.display = 'none';
            });

            if (url) {
                window.history.pushState({}, '', url);
            }
        }

        function showRecipeDetail(userId, url) {
            recipeListToolbar?.style.setProperty('display', 'none');
            recipeListShell?.style.setProperty('display', 'none');

            recipeDetailPanels.forEach((panel) => {
                panel.style.display = panel.dataset.recipeDetail === String(userId) ? 'grid' : 'none';
            });

            if (url) {
                window.history.pushState({}, '', url);
            }
        }

        async function postRecipeForm(form) {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken,
                },
                credentials: 'same-origin',
            });

            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                const firstError = data.errors ? Object.values(data.errors).flat()[0] : null;
                throw new Error(firstError || data.message || 'No se pudo guardar. Intenta de nuevo.');
            }

            return data;
        }

        searchInputs.forEach((input) => {
            input.addEventListener('input', () => {
                searchInputs.forEach((otherInput) => {
                    if (otherInput !== input) {
                        otherInput.value = input.value;
                    }
                });

                filterRows(input.value);
                filterRecipeRows(input.value);
            });
        });

        document.querySelectorAll('.workspace-search, .workspace-table-search').forEach((form) => {
            if (form.tagName !== 'FORM') {
                return;
            }

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                const input = form.querySelector('input[name="search"]');
                filterRows(input?.value || '');
                filterRecipeRows(input?.value || '');
            });
        });

        if (searchInputs.length > 0) {
            filterRows(searchInputs[0].value);
        }

        if (recipeSearchInput) {
            filterRecipeRows(recipeSearchInput.value);
        }

        document.addEventListener('click', (event) => {
            if (event.defaultPrevented || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) {
                return;
            }

            const detailTrigger = event.target.closest('.workspace-user-trigger');

            if (detailTrigger) {
                event.preventDefault();
                if (detailUserId) {
                    detailUserId.textContent = detailTrigger.dataset.userId || '';
                }
                if (detailUserNombre) {
                    detailUserNombre.textContent = detailTrigger.dataset.userNombre || '';
                }
                if (detailUserCorreo) {
                    detailUserCorreo.textContent = detailTrigger.dataset.userCorreo || '';
                }
                if (detailUserDpi) {
                    detailUserDpi.textContent = detailTrigger.dataset.userDpi || '';
                }
                detailBox?.classList.add('is-visible');
                detailBox?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                return;
            }

            const cargaDeleteButton = event.target.closest('[data-carga-delete-button]');

            if (cargaDeleteButton) {
                event.preventDefault();
                showCargaDeleteConfirm(cargaDeleteButton.closest('form'));
                return;
            }

            const cargaEditButton = event.target.closest('[data-carga-edit-button]');

            if (cargaEditButton) {
                event.preventDefault();
                const row = cargaEditButton.closest('[data-carga-user-id]');

                if (!row) {
                    return;
                }

                showCargaForm({
                    id: row.dataset.cargaUserId || '',
                    nombre: row.dataset.cargaUserNombre || '',
                    correo: row.dataset.cargaUserCorreo || '',
                    dpi: row.dataset.cargaUserDpi || '',
                    updateUrl: row.dataset.cargaUserUpdateUrl || '',
                });
                return;
            }

            const agendaStatusButton = event.target.closest('[data-agenda-status-button]');

            if (agendaStatusButton) {
                event.preventDefault();
                const row = agendaStatusButton.closest('[data-agenda-appointment-row]');
                const statusUrl = row?.dataset.agendaStatusUrl || '';

                if (!row || !statusUrl) {
                    return;
                }

                if (row.dataset.agendaCompleted === '1' && !isAgendaAppointmentUpcoming(row)) {
                    updateAgendaStatusButton(agendaStatusButton, true, row);
                    placeAgendaAppointmentRow(row);
                    showFloatingToast('Cita caducada.');
                    return;
                }

                agendaStatusButton.setAttribute('disabled', 'disabled');

                fetch(statusUrl, {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    credentials: 'same-origin',
                })
                    .then(async (response) => {
                        const data = await response.json().catch(() => ({}));

                        if (!response.ok) {
                            throw new Error(data.message || 'No se pudo actualizar la cita.');
                        }

                        const isCompleted = Boolean(data.appointment?.is_completed);
                        moveAgendaAppointmentRow(row, isCompleted);
                        showFloatingToast(data.message || 'Cita actualizada correctamente.');
                    })
                    .catch((error) => {
                        showFloatingToast(error.message || 'No se pudo actualizar la cita.');
                    })
                    .finally(() => {
                        agendaStatusButton.removeAttribute('disabled');
                    });
                return;
            }

            const link = event.target.closest('a');

            if (!link || link.target || link.hasAttribute('download')) {
                return;
            }

            const url = new URL(link.href, window.location.href);
            const section = getPanelSectionFromUrl(url);

            if (!section) {
                return;
            }

            const isSoftRecipeFilter = section === 'recetas' && url.searchParams.has('recipe_range') && !url.searchParams.has('recipe_user');
            const isModuleNavigation = link.classList.contains('menu-item')
                || link.classList.contains('module-button')
                || isSoftRecipeFilter;

            if (!isModuleNavigation) {
                return;
            }

            if (section === 'recetas' && url.searchParams.has('recipe_range') && !url.searchParams.has('recipe_user')) {
                event.preventDefault();
                activatePanelSection(section, url);
                filterRecipeRange(url.searchParams.get('recipe_range') || 'todos');
                sortRecipeRows();
                return;
            }

            event.preventDefault();
            activatePanelSection(section, url);
        });

        window.addEventListener('popstate', () => {
            const section = getPanelSectionFromUrl(new URL(window.location.href));

            if (section) {
                activatePanelSection(section);
            }
        });

        recipeOpenLinks.forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                showRecipeDetail(link.dataset.recipeUserId, link.href);
            });
        });

        recipeBackLinks.forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                showRecipeList(link.href);
            });
        });

        recipeRangeSelects.forEach((select) => {
            select.addEventListener('change', async () => {
                const form = select.closest('form');
                const previousValue = select.dataset.currentRange || select.value;

                if (!form) {
                    return;
                }

                try {
                    const data = await postRecipeForm(form);
                    const nextRange = data.rango_receta || select.value;

                    select.classList.remove('recipe-range-alto', 'recipe-range-medio', 'recipe-range-bajo');
                    select.classList.add(`recipe-range-${nextRange}`);
                    select.value = nextRange;
                    select.defaultValue = nextRange;
                    select.dataset.currentRange = nextRange;
                    form.closest('[data-recipe-row]')?.setAttribute('data-recipe-range', nextRange);
                    sortRecipeRows();
                } catch (error) {
                    select.value = previousValue;
                    console.error(error);
                }
            });
        });

        recipeForms.forEach((form) => {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const button = form.querySelector('button[type="submit"]');
                const detail = form.closest('[data-recipe-detail]');
                const imagePreview = detail?.querySelector('[data-recipe-image-preview]');

                button?.setAttribute('disabled', 'disabled');

                try {
                    const data = await postRecipeForm(form);

                    if (data.image_url && imagePreview) {
                        imagePreview.innerHTML = `<img src="${data.image_url}" alt="Referencia de receta">`;
                    }

                    const fileInput = form.querySelector('input[type="file"]');
                    if (fileInput) {
                        fileInput.value = '';
                    }

                    showFloatingToast(data.message || 'Opinion enviada correctamente.');
                } catch (error) {
                    showFloatingToast(error.message || 'No se pudo enviar la opinion.');
                } finally {
                    button?.removeAttribute('disabled');
                }
            });
        });

        detailTriggers.forEach((trigger) => {
            trigger.addEventListener('click', () => {
                detailUserId.textContent = trigger.dataset.userId;
                detailUserNombre.textContent = trigger.dataset.userNombre;
                detailUserCorreo.textContent = trigger.dataset.userCorreo;
                detailUserDpi.textContent = trigger.dataset.userDpi;
                detailBox.classList.add('is-visible');
                detailBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        if (historyUserSearch && historyUserList && historyUserLinks.length > 0) {
            historyUserSearch.addEventListener('input', () => {
                const normalized = historyUserSearch.value.trim().toLowerCase();
                const isFiltering = normalized.length > 0;

                historyUserList.classList.toggle('is-filtering', isFiltering);

                historyUserLinks.forEach((link) => {
                    const text = link.dataset.historyUserText || '';
                    const matches = text.includes(normalized);
                    link.classList.toggle('is-match', matches);
                });
            });
        }

        function setActiveHistoryDay(trigger) {
            if (!trigger || !historyDayDetail) {
                return;
            }

            historyDayTriggers.forEach((item) => item.classList.remove('is-active'));
            trigger.classList.add('is-active');
            historyDaysShell?.classList.add('is-hidden');
            historyDayDetail.classList.add('is-visible');

            if (historyDetailDate) {
                historyDetailDate.textContent = `${trigger.dataset.historyFecha} ${trigger.dataset.historyHora}`;
            }

            if (historyDetailTitulo) {
                historyDetailTitulo.textContent = trigger.dataset.historyTitulo;
            }

            if (historyDetailCalorias) {
                historyDetailCalorias.textContent = trigger.dataset.historyCalorias;
            }

            if (historyDetailCarbohidratos) {
                historyDetailCarbohidratos.textContent = trigger.dataset.historyCarbohidratos;
            }

            if (historyDetailProteina) {
                historyDetailProteina.textContent = trigger.dataset.historyProteina;
            }

            if (historyDetailGrasas) {
                historyDetailGrasas.textContent = trigger.dataset.historyGrasas;
            }
        }

        historyDayTriggers.forEach((trigger) => {
            trigger.addEventListener('click', () => {
                setActiveHistoryDay(trigger);
                historyDayDetail?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
        });

        if (historyBackButton) {
            historyBackButton.addEventListener('click', () => {
                historyDayTriggers.forEach((item) => item.classList.remove('is-active'));
                historyDayDetail?.classList.remove('is-visible');
                historyDaysShell?.classList.remove('is-hidden');
                historyDaysShell?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
        }

        agendaTypeInputs.forEach((input) => {
            input.addEventListener('change', syncAgendaClientFields);
        });

        if (agendaClientSearch) {
            agendaClientSearch.addEventListener('input', () => {
                filterAgendaClientCards(agendaClientSearch.value);
            });
        }

        agendaClientCards.forEach((card) => {
            card.addEventListener('click', () => {
                fillAgendaClientFromCard(card);
            });
        });

        syncAgendaClientFields();
        filterAgendaClientCards(agendaClientSearch?.value || '');

        billingTypeInputs.forEach((input) => {
            input.addEventListener('change', syncBillingClientFields);
        });

        billingNewNameInput?.addEventListener('input', updateBillingSubmitState);
        billingNewEmailInput?.addEventListener('input', updateBillingSubmitState);

        if (billingClientSearch) {
            billingClientSearch.addEventListener('input', () => {
                filterBillingClientCards(billingClientSearch.value);
            });
        }

        billingClientCards.forEach((card) => {
            card.addEventListener('click', () => {
                fillBillingClientFromCard(card);
            });
        });

        if (billingCostInput) {
            billingCostInput.addEventListener('input', updateBillingTotal);
        }

        if (billingExtrasList) {
            billingExtrasList.addEventListener('input', (event) => {
                if (event.target.matches('[data-billing-extra-amount]')) {
                    updateBillingTotal();
                }
            });

            billingExtrasList.addEventListener('click', (event) => {
                const removeButton = event.target.closest('.billing-remove-extra');

                if (!removeButton) {
                    return;
                }

                const rows = getBillingExtraRows();
                const row = removeButton.closest('.billing-extra-row');

                if (rows.length <= 1) {
                    row?.querySelector('input[type="text"]')?.setAttribute('value', '');
                    const textInput = row?.querySelector('input[type="text"]');
                    const amountInput = row?.querySelector('[data-billing-extra-amount]');
                    if (textInput) {
                        textInput.value = '';
                    }
                    if (amountInput) {
                        amountInput.value = '';
                    }
                } else {
                    row?.remove();
                    updateBillingExtraIndexes();
                }

                updateBillingTotal();
            });
        }

        if (addBillingExtraButton) {
            addBillingExtraButton.addEventListener('click', () => {
                createBillingExtraRow();
            });
        }

        if (billingForm) {
            billingForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                 updateBillingSubmitState();

                if (billingSubmitButton?.disabled) {
                    showFloatingToast('Selecciona un cliente registrado o ingresa un cliente nuevo antes de facturar.');
                    return;
                }

                const submitButton = billingForm.querySelector('button[type="submit"]');
                submitButton?.setAttribute('disabled', 'disabled');

                try {
                    const response = await fetch(billingForm.action, {
                        method: 'POST',
                        headers: {
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: new FormData(billingForm),
                    });

                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        const firstError = Object.values(data.errors || {})[0];
                        const message = Array.isArray(firstError) ? firstError[0] : (data.message || 'No se pudo generar la factura.');
                        throw new Error(message);
                    }

                    prependBillingAuditRow(data.invoice || null);
                    updateBillingCutSummary(data.cut_total || 0, data.cut_client_count || 0);
                    resetBillingFormState();
                    showFloatingToast(data.message || 'Factura generada correctamente.');
                    triggerFileDownload(data.download_url || '');
                } catch (error) {
                    showFloatingToast(error.message || 'No se pudo generar la factura.');
                } finally {
                    submitButton?.removeAttribute('disabled');
                }
            });
        }

        syncBillingClientFields();
        filterBillingClientCards(billingClientSearch?.value || '');
        updateBillingExtraIndexes();
        updateBillingTotal();
        updateBillingSubmitState();
        ensureBillingAuditEmptyState();
        refreshAgendaTimeStatus();
        refreshRescheduleTimeStatus();
        window.setInterval(() => {
            refreshAgendaTimeStatus();
            refreshRescheduleTimeStatus();
        }, 10000);
    </script>
</body>
</html>
