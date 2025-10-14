# Automatic Scheduled News Publisher

## 🎯 Overview
Sistem ini akan **OTOMATIS** mempublish artikel yang dijadwalkan sesuai dengan waktu yang ditentukan di `published_at`.

## 📁 Files Created
1. `app/Console/Commands/PublishScheduledNews.php` - Command untuk auto-publish
2. `app/Console/Kernel.php` - Scheduler configuration  
3. Manual trigger di `app/Http/Controllers/Admin/NewsController.php`

## ⚙️ How Automatic System Works

### 1. Create Scheduled Article
- Buat artikel baru dengan status `Scheduled`
- Set `published_at` untuk waktu yang diinginkan
- Artikel tersimpan dengan status `scheduled`

### 2. Automatic Publishing (Every Minute)
- Laravel scheduler menjalankan command `news:publish-scheduled` **setiap menit**
- Command mencari artikel dengan:
  - Status = `scheduled` 
  - `published_at` <= waktu sekarang
- Artikel yang ditemukan otomatis berubah status ke `published`

### 3. Manual Publishing (Optional)
- Klik "Publish Scheduled" untuk test manual
- Hanya mempublish artikel yang sudah waktunya

## 🚀 Setup for Automatic Publishing

### 1. Add Cron Job to Server
Tambahkan ini ke crontab server (jalankan sekali saja):
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

**Contoh untuk server Linux:**
```bash
# Edit crontab
crontab -e

# Tambahkan baris ini:
* * * * * cd /var/www/crimewatch-backend && php artisan schedule:run >> /dev/null 2>&1
```

### 2. Verify Scheduler is Working
```bash
# Test command manually
php artisan news:publish-scheduled

# Check scheduled tasks
php artisan schedule:list

# Run scheduler manually (for testing)
php artisan schedule:run
```

## 🧪 Testing Automatic System

### 1. Create Test Article
- Buat artikel dengan status `Scheduled`
- Set `published_at` ke waktu **2-3 menit** dari sekarang
- Save artikel

### 2. Wait for Automatic Publishing
- **Tunggu 2-3 menit** (scheduler berjalan setiap menit)
- Artikel akan **otomatis** berubah status ke `Published`

### 3. Verify Results
- Check admin panel: status berubah ke `Published`
- Check frontend: artikel muncul di website

## 📋 Production Checklist

- [ ] Cron job sudah ditambahkan ke server
- [ ] Timezone sudah di-set ke `Asia/Jakarta` di `.env`
- [ ] Test artikel scheduled berhasil publish otomatis
- [ ] Scheduler berjalan setiap menit tanpa error

## 🔧 Troubleshooting

### Scheduler Tidak Berjalan
```bash
# Check if cron is running
sudo service cron status

# Check cron logs
sudo tail -f /var/log/cron

# Test Laravel scheduler
php artisan schedule:run
```

### Command Error
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Test command manually
php artisan news:publish-scheduled
```

## ✅ Benefits of Automatic System
- ✅ Artikel publish **tepat waktu** tanpa manual
- ✅ Tidak perlu ingat untuk publish artikel
- ✅ Bisa schedule artikel untuk jam-jam yang tidak aktif
- ✅ Sistem berjalan 24/7 otomatis
