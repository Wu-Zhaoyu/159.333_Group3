<script setup>
// import { useUserStore } from '@/stores/userStore'
import { useRouter } from 'vue-router'

import { inject } from 'vue'
import { ref } from 'vue'
// const userStore = useUserStore()
const router = useRouter()

// 获取全局状态
const globalState = inject('globalState')
const confirm = () => {
  sessionStorage.removeItem('token'); // 假设你的令牌存储在localStorage中
  globalState.value.user = null;
  globalState.value.role = null;
  // localStorage.clear();
  // 清除令牌，这可能涉及清除Cookies或本地存储中的令牌
  sessionStorage.removeItem('globalState'); // 清除用户信息
  sessionStorage.clear();
  router.push({ path: '/' });
  // localStorage.removeItem('user'); // 清除用户角色
  // localStorage.removeItem('role'); // 清除用户角色
}

</script>

<template>
  <nav class="app-topnav">
    <div class="container">
      <ul>
        <template v-if="globalState.user">
          <li><a href="javascript:;"><i class="iconfont icon-user"></i>{{ globalState.user }}</a></li>
          <li>
            <el-popconfirm title="Confirm exit?" @confirm="confirm" confirm-button-text="Yes" cancel-button-text="No">
              <template #reference>
                <a href="javascript:;">Sign Out</a>
              </template>
            </el-popconfirm>
          </li>
          <template v-if = "globalState.role === 'Employee'">
            <li><a href="javascript:;" @click="$router.push('/ApplicationStatus')">Application Status</a></li>
          </template>
          <template v-else-if = "globalState.role === 'Employer'">
            <li><a href="javascript:;" @click="$router.push('/PostedAD')">Jobs</a></li>
          </template>
        </template>
        <template v-else>
          <li><a href="javascript:;" @click="$router.push('/login')">Login</a></li>
        </template>
      </ul>
    </div>
  </nav>
</template>


<style scoped lang="scss">
.app-topnav {
  background: #333;
  ul {
    display: flex;
    height: 53px;
    justify-content: flex-end;
    align-items: center;
    li {
      a {
        padding: 0 15px;
        color: #cdcdcd;
        line-height: 1;
        display: inline-block;

        i {
          font-size: 14px;
          margin-right: 2px;
        }

        &:hover {
          color: $xtxColor;
        }
      }

      ~li {
        a {
          border-left: 2px solid #666;
        }
      }
    }
  }
}
</style>