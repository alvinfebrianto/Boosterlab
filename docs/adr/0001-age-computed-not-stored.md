# Age is a computed property, not a stored column

The `anaks` table previously stored age (`umur`) as a formatted string (e.g. "1 tahun 2 bulan 3 hari") computed at create/update time. This drifted from the real age over time. We removed the column and compute age on-the-fly from `tanggal_lahir` via an Eloquent accessor inside the PertumbuhanAnak module. Age is now always current: a pure function of birth date + today.

**Alternatives considered:**
- Keep the column and refresh it with a scheduled job — adds cron infrastructure for a problem that doesn't need it.
- Compute at read time in every controller — duplicates logic. The module centralises it.

**Consequences:** Age queries now require a computation rather than a column read. This is irrelevant at this application's scale (hundreds of children, not millions). If performance ever becomes a concern, add a cached accessor — the interface stays the same.
